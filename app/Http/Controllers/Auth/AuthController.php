<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LogoutResponse;

use App\Models\User;

use App\Http\Requests\Business\Login\LoginUserRequest;
use App\Http\Requests\Business\Login\RegisterUserRequest;

use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected $guard;
    protected $user;

    public function __construct(StatefulGuard $guard, User $user)
    {
        $this->guard = $guard;
        $this->user = $user;
    }

    public function login(LoginUserRequest $request)
    {
        $request->validated();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->canAuthenticate()) {

                if ($request->hasSession()) {
                    $request->session()->regenerateToken();
                }

                return redirect()->intended('/dashboard');
            } else {
                Auth::logout();

                if ($request->hasSession()) {
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                }

                return back()->with('error', 'Acesso negado.');
            }
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

     public function register(RegisterUserRequest $request)
    {
        $request->validated();

        $user = $this->user->create([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'password' => Crypt::encrypt($request->password),
            'is_active' => 1,
            'created_at' => Carbon::now()
        ])->assignRole($request->role);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->canAuthenticate()) {

                if ($request->hasSession()) {
                    $request->session()->regenerateToken();
                }

                return redirect()->intended('/dashboard');
            } else {
                Auth::logout();

                if ($request->hasSession()) {
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                }

                return back()->with('error', 'Acesso negado.');
            }
        }

        // Se falhar a autenticação, retorna um erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return app(LogoutResponse::class);
    }

    public function loginView()
    {
        return view('app.auth.login');
    }

    public function registerView()
    {
        return view('app.auth.register');
    }
}