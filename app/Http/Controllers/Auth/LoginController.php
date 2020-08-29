<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Athlete;
use App\Models\Coach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function socialRedirect(Request $request) 
    {
        $this->validate($request, [
            'social_type' => 'required|in:strava'
        ]);

        $socialType = $request->get('social_type');

        \Session::put('social_type',$socialType);

        return \Socialite::with($socialType)
                            ->setScopes(['profile:read_all', 'activity:read_all'])
                            ->redirect();
    }

    public function socialCallback() 
    {
        $socialType = \Session::get('social_type');

        try {
            $userSocial = \Socialite::driver($socialType)->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $user = User::where($socialType.'_id', $userSocial->id)->first();

        if(!$user){
            return view('auth.register', compact('userSocial'));
        }

        \Auth::login($user); //fazendo o login manual

        return redirect()->intended($this->redirectPath());
    }

    public function redirectTo()
    {
        if (\Auth::user()->containsType(Admin::class)){
            $userableType = \Auth::user()->admin->pivot->userable_type;
        } else if (\Auth::user()->containsType(Coach::class)){
            $userableType = \Auth::user()->coach->pivot->userable_type;
        } else if (\Auth::user()->containsType(Athlete::class)){
            $userableType = \Auth::user()->athlete->pivot->userable_type;
        } else {
            $userableType = 'App\Models\Athlete';
        }
     
        $userableType = str_replace('\\', '_', $userableType);

        return \Section::get("login.$userableType.redirect");
    }
 
    protected function credentials(Request $request)
    {
        // Recupera os dados vindos do Form como e-mail e password
        $data = $request->only($this->username(), 'password');

        // Verifica se o tipo de login é diferente de e-mail
        // Caso for, atribui ele a variável $data e excluo o $data['email']
        if ($this->usernameKey() != $this->username()) {
            $data[$this->usernameKey()] = $data[$this->username()];
            unset($data[$this->username()]);
        }

        return $data;
    }

    protected function usernameKey()
    {
        $email = \Request::get('email');
        $validator = \Validator::make(['email' => $email], ['email' => 'cpf']);

        if (!$validator->fails()) {
            return 'cpf';
        }
        
        return 'email';
    }
}
