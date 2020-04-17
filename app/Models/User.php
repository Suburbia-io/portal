<?php

namespace App\Models;

use App\Helpers\TwoFactorOtp;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RobThree\Auth\TwoFactorAuthException;

class User extends BaseUser
{
    use Notifiable;

    protected $fillable = ['email', 'name', 'password', 'is_admin', 'otp_secret', 'last_login_at', 'login_nonce', 's3_key', 's3_secret'];
    protected $casts = ['last_login_at' => 'datetime', 'is_admin' => 'bool'];

    /**
     * The datasets this user has access to.
     * @return BelongsToMany
     */
    public function datasets() :BelongsToMany {
        return $this->belongsToMany(Dataset::class, 'user_datasets', 'user_id', 'dataset_id');
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->attributes['name'] = $name;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email) {
        $this->attributes['email'] = $email;
    }

    /**
     * @param string $plainText
     */
    public function setPassword(string $plainText) {
        $this->attributes['password'] = Hash::make($plainText);
    }

    /**
     * make this user admin
     */
    public function giveAdminStatus() {
        $this->attributes['is_admin'] = true;
    }

    /**
     * demote this user from its admin status
     */
    public function revokeAdminStatus() {
        $this->attributes['is_admin'] = false;
    }

    /**
     * Generate a new OTP secret for this user
     * @param $secret
     * @return string
     */
    public function setOtpSecret($secret) {
        $this->attributes['otp_secret'] = $secret;
    }

    /**
     * get last login datetime of this user
     * @return Carbon
     */
    public function getLastLogin() :?Carbon {
        return $this->attributes['last_login_at'];
    }

    /**
     * @return string
     */
    public function getEmail() :string {
        return $this->attributes['email'];
    }

    /**
     * @return string
     */
    public function getName() :string {
        return $this->attributes['name'];
    }

    /**
     * get the password hash
     * @return string
     */
    public function getPassword() :string {
        return $this->attributes['password'];
    }

    /**
     * Validate if a given OTP is valid for this user
     * @param string $otp
     * @return bool
     */
    public function validateOtp(string $otp) :bool {
        return TwoFactorOtp::verifyOtp($this->attributes['otp_secret'], $otp);
    }

    /**
     * @return bool
     */
    public function isAdmin() :bool {
        return $this->attributes['is_admin'];
    }

    /**
     * Set last login time for this user to the current datetime
     */
    public function touchLastLogin() {
        $this->attributes['last_login_at'] = Carbon::now();
    }

    /**
     * @param string|null $nonce
     */
    public function setLoginNonce(?string $nonce = null) {
        $this->attributes['login_nonce'] = $nonce;
    }

    /**
     * @param string $test
     * @return bool
     */
    public function checkLoginNonce(string $test) {
        return $this->attributes['login_nonce'] === $test;
    }

    /**
     * @return array
     */
    public function generateS3Credentials() :array {
        $key = Str::random(20); // max length based on Minio Server source code
        $secret = Str::random(40); // max length based on Minio Server source code

        $this->attributes['s3_key'] = $key;
        $this->attributes['s3_secret'] = $secret;

        return [
            'key' => $key,
            'secret' => $secret,
        ];
    }

    /**
     * @return array
     */
    public function getS3Credentials() :array {
        return [
            'key' => $this->attributes['s3_key'],
            'secret' => $this->attributes['s3_secret'],
        ];
    }

    /**
     * Check if this user has access via S3 set up
     * @return bool
     */
    public function hasS3setup() :bool {
        return !empty($this->attributes['s3_key']) && !empty($this->attributes['s3_secret']);
    }

    /**
     * TODO
     * @return bool
     */
    public function hasSftpSetup() :bool {
        return !empty($this->attributes['sftp_public_key']);
    }
}
