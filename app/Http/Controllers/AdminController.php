<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends BaseController
{
    public function getDatasets() {

    }

    public function createDataset() {

    }

    public function getUsers() {
        $users = User::all();
        return view('dashboard.adminUsers', [
            'users' => $users,
        ]);
    }

    public function createUser() {

    }
}
