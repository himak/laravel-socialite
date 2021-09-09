<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
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

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($service)
    {
        $oauth_user = Socialite::driver($service)->user();

        // get user by email or create a new one
        $user = \App\Models\User::firstOrCreate([
            'name' => $oauth_user->name,
            'email' => $oauth_user->email,
            'password' => '',
            'image' => $oauth_user->avatar,
            'service' => $service,
            'service_id' => $oauth_user->id,
        ]);

        // log the user in
        \Auth::login($user, true);

        Session::flash('status', 'Log in with ' . ucfirst($service) . ' was successful!');

        return redirect('home');
    }
}
