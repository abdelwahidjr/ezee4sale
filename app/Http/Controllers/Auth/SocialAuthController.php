<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Socialite;
use App\Models\SocialProvider;
use App\Models\User;
use App\Mail\SocialRegister;
use Illuminate\Support\Facades\Auth;
class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider_name)
    {
        return Socialite::driver($provider_name)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider_name)
    {

        if($provider_name == 'google')
            $user = Socialite::driver($provider_name)->stateless()->user();
        else
            $user = Socialite::driver($provider_name)->user();

        $userProvider = SocialProvider::where('provider_id' , $user->getId())->first();

        if($userProvider){
            $existUser = User::find($userProvider->user_id);
        }else{
            $existUser = User::where('email' , $user->getEmail())->first();

            if(!$existUser){
                $userPassword = str_random(32);
                $existUser = new User();
                $existUser->name = $user->getName();
                $existUser->email = $user->getEmail();
                $existUser->password = bcrypt($userPassword);
                $existUser->active = 1;
                $existUser->save();

                Mail::to($user->getEmail())->queue(new SocialRegister($existUser , $userPassword));
            }

            $userProvider = new SocialProvider();
            $userProvider->provider_id = $user->getId();
            $userProvider->provider_name = $provider_name;
            $userProvider->user_id = $existUser->id;
            $userProvider->save();
        }

        $attempt = Auth::login($existUser);

        return redirect('/home');

    }
}
