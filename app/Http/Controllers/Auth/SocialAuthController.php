<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('12345678'), // dummy password
            ]
        );

        Auth::login($user, true);

        // Buat token Sanctum
        $token = $user->createToken('token')->plainTextToken;

        // ✅ Redirect ke frontend React sambil bawa token-nya
        return redirect("http://localhost:5173/auth/callback?token={$token}");
    }



public function redirectToFacebook()
{
    return Socialite::driver('facebook')->redirect();
}

public function handleFacebookCallback()
{
    try {
        $fbUser = Socialite::driver('facebook')->stateless()->user();

        $name = $fbUser->getName();
        $email = $fbUser->getEmail();

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt('facebook'),
            ]);
        }

        auth()->login($user);

        // ✅ Tambah redirect dengan token ke React
        $token = $user->createToken('token')->plainTextToken;
        return redirect("http://localhost:5173/auth/callback?token={$token}");
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


}
