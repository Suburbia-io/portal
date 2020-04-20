<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\AuthLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{

    public function showAuthForm() {
        return view('auth._base');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function submitAuthForm(Request $request) {
        $this->validate($request, [
            'email' => ['required', 'email'],
        ]);

        /** @var User $user */
        $user = User::where('email', '=', $request->get('email'))->first();
        if (empty($user)) {
            return redirect()->back()->with([
                'info' => 'A login link has been sent to your email address if it\'s known to us.',
            ]);
        }

        // Generate signed url for user and send it via Email
        $user->notify(new AuthLink());

        return redirect()->back()->with([
            'info' => 'A login link has been sent to your email address if it\'s known to us.',
        ]);
    }

    public function loginLink(Request $request) {
        // Validate if the signature of the URL is still valid
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        /** @var User $user */
        $user = User::findOrFail($request->get('user'));

        if (!$user->checkLoginNonce($request->get('nonce'))) {
            abort(401);
        }

        // at this point we know the link is valid:
        // signature is OK, user exists, nonce is OK.

        // reset the login nonce so the link can't be used another time
        $user->setLoginNonce(null);
        $user->touchLastLogin();
        $user->save();

        // log the user in
        auth()->loginUsingId($user->getAuthIdentifier());

        return redirect()->route('dashboard');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth');
    }

    public function showTwoFactorForm() {

    }

    public function submitTwoFactorForm() {

    }

}
