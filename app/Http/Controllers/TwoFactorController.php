<?php

namespace App\Http\Controllers;

use App\Helpers\TwoFactorOtp;
use App\Models\User;
use RobThree\Auth\TwoFactorAuthException;

class TwoFactorController
{

    public function showTwoFactorForm() {

    }

    public function submitTwoFactorForm() {

    }

    /**
     * @throws TwoFactorAuthException
     */
    public function showTwoFactorSetupForm() {
        $secret = TwoFactorOtp::generateOtpSecret();
        $issuer = config('app.name');
        /** @var User $user */
        $user = auth()->user();
        $otpUrl = "otpauth://totp/{$issuer}:{$user->getEmail()}?secret={$secret}&issuer={$issuer}";
        $qr = new QrCode($otpUrl);
    }

    public function submitTwoFactorSetupForm() {

    }

}
