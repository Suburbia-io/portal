<?php

namespace App\Http\Controllers;

class S3Controller extends BaseController
{

    public function getS3Setup() {
        return view('dashboard.s3');
    }

    public function postS3Setup() {

    }

}
