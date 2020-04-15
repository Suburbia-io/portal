<?php

namespace App\Http\Controllers;

use App\Models\User;

class S3Controller extends BaseController
{

    public function getS3Setup() {
        /** @var User $user */
        $user = auth()->user();
        return view('dashboard.s3', $user->getS3Credentials());
    }

    public function postS3Setup() {
        /** @var User $user */
        $user = auth()->user();
        $user->generateS3Credentials();
        $user->save();
        return redirect()->back();
    }

}
