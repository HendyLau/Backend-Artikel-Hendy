<?php
namespace App\Http\Controllers\Api;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;

class SocialAuthController extends Controller
{
   public function callback($provider)
{
    $socialUser = Socialite::driver($provider)->stateless()->user();

    // Temukan atau buat user
    $user = User::firstOrCreate(
        ['email' => $socialUser->getEmail()],
        ['name' => $socialUser->getName()]
    );

    Auth::login($user);

    $token = $user->createToken('token')->plainTextToken;

    return redirect("http://localhost:5173/social-login?token={$token}");
}

public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $fbUser = Socialite::driver('facebook')->user();

        $user = User::updateOrCreate(
            ['email' => $fbUser->getEmail()],
            ['name' => $fbUser->getName()]
        );

        Auth::login($user);

        return redirect('http://localhost:8000'); // Redirect ke React frontend
    }

}
