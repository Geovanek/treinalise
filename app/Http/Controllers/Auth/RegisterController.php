<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => 'required',
            'cpf' => 'required|cpf',
            'sex' => ['string', 'max:1', 'nullable'],
            'weight' => ['numeric', 'nullable'],
            'avatar' => ['string', 'nullable'],
            'company_id' => ['numeric', 'nullable'],
            'coach_id' => ['numeric', 'nullable'],
            'strava_id' => ['numeric', 'nullable'],
            'strava_access_token' => ['string', 'nullable'],
            'strava_refresh_token' => ['string', 'nullable'],
            'strava_access_token_expires_at' => ['numeric', 'nullable'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                return User::updateOrCreate(
                    [
                    'email' => $data['email']
                    ], [
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'cpf' => $data['cpf'],
                    'sex' => $data['sex'],
                    'weight' => $data['weight'],
                    'avatar' => $data['avatar'],
                    //'company_id' => $data['company_id'],
                    //'coach_id' => $data['coach_id'],
                    'strava_id' => $data['strava_id'],
                    'strava_access_token' => $data['strava_access_token'],
                    'strava_refresh_token' => $data['strava_refresh_token'],
                    'strava_access_token_expires_at' => $data['strava_access_token_expires_at'],
                ]);
            } else {
                $validator = Validator::make($data, [
                    'email' => ['unique:users'],
                ]);

                if ($validator->fails()) {
                   return $validator;
                }
            }
        } else {
            return User::create(
                [
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
                'phone' => $data['phone'],
                'cpf' => $data['cpf'],
                'sex' => $data['sex'],
                'weight' => $data['weight'],
                'avatar' => $data['avatar'],
                //'company_id' => $data['company_id'],
                //'coach_id' => $data['coach_id'],
                'strava_id' => $data['strava_id'],
                'strava_access_token' => $data['strava_access_token'],
                'strava_refresh_token' => $data['strava_refresh_token'],
                'strava_access_token_expires_at' => $data['strava_access_token_expires_at'],
            ]);
        }
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //dd($user);
        if (method_exists($user, 'validate')) {
            return $user->validate();
        }

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
