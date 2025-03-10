<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {


        $rules = [
            'givenname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^[0-9a-zA-ZöäüÖÄÜ_\-.]+$/m', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'captcha' => ['required', 'captcha']
        ];
        $customMessages = [
            'givenname.required' => 'Bitte geben Sie Ihren Vornamen an.',
            'givenname.max' => 'Der Vorname darf maximal 255 Zeichen lang sein.',
            'name.required' => 'Bitte geben Sie Ihren Namen an.',
            'name.max' => 'Der Name darf maximal 255 Zeichen lang sein.',
            'captcha.captcha' => 'Das eingegebene Captcha war falsch.',
            'captcha.required' => 'Bitte geben Sie das oben stehende Captcha ein.',
        ];

        return Validator::make($data, $rules, $customMessages);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'givenname' => $data['givenname'],
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(80),
            'crowncnt' => 0,
        ]);
    }

    public function refreshCaptcha() {
        return response()->json(['captcha' => captcha_img('flat')]);
    }
}
