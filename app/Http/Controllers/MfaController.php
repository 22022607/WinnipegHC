<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MfaController extends Controller
{
    public function showSetup()
    {
        $user = Auth::user();
        $google2fa = new Google2FA();

        // Generate a new secret if not set
        if (!$user->google2fa_secret) {
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            'WinnipegHC',
            $user->email,
            $user->google2fa_secret
        );
        // Use QrCode package to generate image
        $qr = QrCode::size(200)->generate($qrCodeUrl);

        return view('mfa.setup', [
            'qr' => $qr,
            'secret' => $user->google2fa_secret
        ]);
    }

    public function verify(Request $request)
    {
        $user = Auth::user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('one_time_password'));

        if ($valid) {
            $user->mfa_verified = true; // If you add this boolean to your users table.
            $user->save();
            return redirect()->route('dashboard')->with('success', 'MFA Verified!');
        }
        return back()->with('error', 'Invalid code—please try again.');
    }
}
