<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;
use Illuminate\Http\Request;

class Admin2FAController extends Controller
{
    protected $google2fa;

    public function __construct(Google2FA $google2fa)
    {
        $this->google2fa = $google2fa;
    }

    public function enable2FA(Request $request)
    {
        $user = Auth::user();
        $administrateur = $user->administrateur;

        if (!$administrateur) {
            return response()->json(['error' => 'No associated administrator found.'], 404);
        }

        $secret = $this->google2fa->generateSecretKey();
        $administrateur->google2fa_secret = $secret;
        $administrateur->save();

        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        return response()->json(['qrCodeUrl' => $qrCodeUrl, 'secret' => $secret]);
    }

    public function verify2FA(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required',
        ]);

        $user = Auth::user();
        $administrateur = $user->administrateur;

        if (!$administrateur) {
            return response()->json(['error' => 'No associated administrator found.'], 404);
        }

        $secret = $administrateur->google2fa_secret;
        $valid = $this->google2fa->verifyKey($secret, $request->input('one_time_password'));

        if ($valid) {
            $administrateur->google2fa_enabled = true;
            $administrateur->save();

            return response()->json(['message' => '2FA enabled successfully']);
        }

        return response()->json(['error' => 'Invalid verification code'], 422);
    }
}
