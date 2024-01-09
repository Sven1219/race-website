<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;

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
        // if(!file_exists(storage_path() . "/installed"))
        // {
        //     header('location:install');
        //     die;
        // }
        //$this->middleware('guest')->except('logout');
    }

    public function __invoke($lang = '')
    {
        if ($lang == '') {
            $lang = env('TAILAX_LANG') ?? 'en';
        }
        \App::setLocale($lang);
        return view('auth.login', compact('lang'));
    }

    public function authLogin(LoginRequest $request)
    {
        if(env('GOOGLE_CAPTCHA') === 'yes'){
            $validation['g-recaptcha-response'] = 'required|captcha';
        }else{
            $validation = [];
        }
        $this->validate($request, $validation);
        $request->authenticate();

        $email    = $request->has('email') ? $request->email : '';
        $password    = $request->has('password') ? $request->password : '';
        if(Auth::attempt([ 'email' => $email, 'password' => $password])){
            return redirect()->intended('/');
        }else{
            return redirect()->back()->with('error', __('Credentials Doesn\'t Match !'));
        }
    }

    public function authLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
