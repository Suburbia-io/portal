<?php


namespace App\Helpers;

use RobThree\Auth\TwoFactorAuth;
use RobThree\Auth\TwoFactorAuthException;

/**
 * A simple wrapper around a TwoFactorAuth library.
 * @package App\Helpers
 */
class TwoFactorOtp
{
    private const ISSUER_NAME = 'Suburbia.io';

    /**
     * Gets the underlying two factor auth library that is used
     * @return TwoFactorAuth
     */
    private static function getTfaLibrary() :TwoFactorAuth {
        return $tfa = new TwoFactorAuth(self::ISSUER_NAME);
    }

    /**
     * Generate a shared OTP secret for a user
     * @return string
     * @throws TwoFactorAuthException
     */
    public static function generateOtpSecret() :string {
        return self::getTfaLibrary()->createSecret();
    }

    /**
     * Validate if a given OTP is correct for a given secret
     * @param string $secret
     * @param string $otp
     * @return bool
     */
    public static function verifyOtp(string $secret, string $otp) :bool {
        return self::getTfaLibrary()->verifyCode($secret, $otp);
    }
}
