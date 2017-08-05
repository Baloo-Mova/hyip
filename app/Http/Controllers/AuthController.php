<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('guest.login');
    }

    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(), with(new LoginRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $user  = User::where('email', $request->get('email'))->first();

        switch ($user->role) {
            case 1:
                $guard      = 'users';
                $redirect   = '/cabinet';
                break;
            case 2:
                $guard      = 'admin';
                $redirect   = '/admin';
                break;
            default:
                $guard      = 'users';
                $redirect   = '/cabinet';
        }

        if (\Auth::guard($guard)->attempt([
            'email'     => $request->get('email'),
            'password'  => $request->get('password')
        ])) {
            $request->session()->regenerate();
            return redirect($redirect);
        }

        return redirect()->back()->withInput($request->all())->withErrors(['password' => ['Incorrect password']]);
    }

    public function registerForm($token = null)
    {
        return view('guest.register', ['token' => $token]);
    }

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), with(new RegisterRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $referral_id = null;
        if ($request->get('token')) {
            $ref = User::where('ref_link', $request->get('token'))->first();
            if (!empty($ref->id)) {
                $referral_id = $ref->id;
            }
        }

        User::create([
            'login'         => $request->get('login'),
            'email'         => $request->get('email'),
            'password'      => \Hash::make($request->get('password')),
            'role'          => 1,
            'balance'       => 0,
            'ref_link'      => str_replace(' ','',md5(uniqid()) . microtime()),
            'referral_id'   => $referral_id,
            'last_activity' => Carbon::now(),
        ]);


        \Auth::guard('users')->attempt([
            'email'     => $request->get('email'),
            'password'  => $request->get('password')
        ]);

        return redirect('/cabinet');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    protected function guard()
    {
        return \Auth::guard();
    }
}
