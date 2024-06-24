<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1- on commence par verifier si l'user a entree les deux champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2-on verifie si l'email de user existe dans notre bdd
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        // 3-apres qu'on a verifier que l'user a deja fait le signup dans notre site using un email on verifie son mdp
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect.']
            ]);
        }

        // 4-si on est arrive la on est sur que l'user a les bon coordonees
        // pour ceci dans cet point on genere un token
        // createToken permet de creer un nouveau token API
        // 'api-token' est un nom arbitraire donne au token, utilise pour identifier le token
        // plainTextToken contient le token en texte clair et non pas hache comme on peut l'enregistrer en le hachant
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
    
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['status' => __($status)])
            : response()->json(['email' => __($status)], 400);
    }



    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successfully'])
            : response()->json(['email' => [__($status)]], 400);
    }
    
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to login, please try again.'], 401);
        }

        $user = User::where('email', $socialUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->name ?? 'Unknown', 
                'email' => $socialUser->email,
                'password' => Hash::make(Str::random(24))
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function cancelAuthorization()
    {
        Log::info('Authorization cancelled by the user.');
        return response()->json(['message' => 'Authorization cancelled successfully.'], 200);
    }

    public function dataDeletion(Request $request)
    {
        $userId = $request->input('user_id');

        try {
            $user = User::findOrFail($userId);
            $user->delete();

            Log::info('Data deletion requested for user: ' . $userId);

            return response()->json(['message' => 'Data deletion request submitted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not found or deletion not possible.', 'details' => $e->getMessage()], 404);
        }
    }
}
