<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;    // Importar Request
use Illuminate\Support\Facades\Auth;  // Importar Auth

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/app/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

   protected function authenticated(Request $request, $user)
    {
        $request->session()->flash('alert_message', 'Seja bem-vindo, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
