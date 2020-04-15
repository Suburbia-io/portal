<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends BaseController
{

    public function getDashboard() {
        /** @var User $user */
        $user = auth()->user();
        return view('dashboard.dashboard', [
            'hasS3' => $user->hasS3setup(),
            'hasSftp' => $user->hasSftpSetup(),
        ]);
    }

}
