<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            $this->username() => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Pemeriksaan tambahan sebelum proses otentikasi
        $credentials = $this->credentials($request);
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('error', 'Email atau Password salah');
        }
    
        // Jika otentikasi berhasil
        $user = Auth::user();
        if ($user->email === 'admin@gmail.com') {
            return redirect('/admin'); // Redirect ke halaman admin jika admin login
        }
    
        return $this->sendLoginResponse($request);
    }
    
    protected function redirectPath()
    {
        // Cek jika pengguna adalah admin dengan email admin@gmail.com
        if (auth()->user()->email === 'admin@gmail.com') {
            return '/admin'; // Redirect ke halaman adminn
        }

        return $this->redirectTo;
    }

}
