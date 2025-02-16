<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $userSocial = Socialite::driver($provider)->user();

        $user = User::where('name', 'like', $userSocial->getNickname())->first();
        if (!$user) {
            $user = User::query()->create([
                'email' => $userSocial->getNickname() . '@laravel.com',
                'name' => $userSocial->getNickname(),
                'password' => 'password'
            ]);
        }
        Auth::login($user);
        return redirect('/');
    }

}
