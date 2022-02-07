<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirect_provider(){
        return Socialite::driver('google')->redirect();
    }

    public function callback_google(){
        $user = Socialite::driver('google')->user();

        $this->registerOrLogin($user);

        return redirect('/');
    }

    public function registerOrLogin($data){
        $user = User::where('email', $data->email)->first();

        if(!$user){
            $user = new User();

            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;

            $user->save();
            $user->profile()->create([
                            'title' => $user->name
                        ]);
            // if($var){
            //     $profile = new profile();

            //     $profile->user_id = User::where('provider_id' , $data->id)->first();
            //     $profile->save();
            // }
            
        }
        Auth::login($user);
    }
}
