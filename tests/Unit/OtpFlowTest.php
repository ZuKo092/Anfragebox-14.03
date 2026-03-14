<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * OTP signup flow – documents the fix for "OTP-Token ungültig" bug.
 * verify-otp must NOT delete the OTP we just marked as used,
 * because create-trial-company needs it for validation.
 */
class OtpFlowTest extends TestCase
{
    public function testVerifyOtpCleanupExcludesCurrentOtp(): void
    {
        $verifyOtp = file_get_contents(__DIR__ . '/../../anfrage/api/verify-otp.php');
        $this->assertStringContainsString(
            'id=neq.',
            $verifyOtp,
            'verify-otp.php must exclude current OTP from cleanup (id=neq) so create-trial-company can validate it'
        );
    }
}
