<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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

    public function login(LoginUserRequest $request)
    {
        $input = $request->validated();
        $response = $this->callAPI("POST", "/users/login", $input);

        $results = $response->json();
        if ($response->status() !== 200) {

            if ($response->status() === 401) {
                return redirect()->back()->with(['msg' => $results['error']]);
            }

            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        session(['currentUser' => $results]);

        return redirect('/home');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
