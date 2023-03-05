<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Rules\ValidLoginField;

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

    protected function authenticated(Request $request, $user)
    {
        $umkm = auth()->user()->umkm;
        if($umkm){
            $umkm->waktu_keterlihatan = now();
            $umkm->save();
        }
        if(auth()->user()->is_admin){
            redirect(route("admin.home"));
            
        }
        else{
            redirect(route("user.home"));
        }
    }

    public function username()
    {
        $loginValue = request()->input('login_field');
        $field = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : (is_numeric($loginValue) ? 'nomor_telepon' : 'nik');
        request()->merge([$field => $loginValue]);
        return $field;
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login_field' => ['required', 'string', new ValidLoginField],
            'password' => ['required', 
                            'string',
                            function ($attribute, $value, $fail) {
                                $user =  $this->findForPassport(request()->input('login_field'));
                                if($user){
                                    if (!\Illuminate\Support\Facades\Hash::check($value,  $user->password)) {
                                        $fail('Password tidak tepat!');
                                    }
                                }
                                else {
                                    $fail('Akun tidak ditemukan!');
                                }
                            },
                          ],
        ]);
    }

    public function findForPassport($identifier) {
        return User::where('email', $identifier)->orWhere('nik', $identifier)->orWhere('nomor_telepon', $identifier)->first();
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
