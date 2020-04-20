<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminController extends BaseController
{
    public function getDatasets() {
        return view('dashboard.adminDatasets', [
            'datasets' => Dataset::all(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function createDataset(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:250|unique:datasets,name',
        ]);
        Dataset::create([
            'name' => $request->get('name'),
        ]);
        return redirect()->back();
    }

    public function getUsers() {
        return view('dashboard.adminUsers', [
            'users' => User::all(),
        ]);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function createUser(Request $request) {
        $this->validate($request, [
           'name' => 'required|string|min:2|max:250',
            'email' => 'required|email|max:250|unique:users,email',
        ]);
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'is_admin' => $request->has('is_admin'),
        ]);
        return redirect()->back();
    }

    public function getUser(User $user) {
        return view('dashboard.adminUser', [
            'user' => $user,
            'datasets' => Dataset::all(),
        ]);
    }

    public function updateUser(Request $request, User $user) {
        $datasetIds = array_keys($request->get('datasets', []));
        $user->datasets()->sync($datasetIds);
        return redirect()->back();
    }
}
