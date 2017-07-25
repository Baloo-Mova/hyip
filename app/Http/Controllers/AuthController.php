<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Validator, Auth, Hash;
class AuthController extends Controller
{
    public function loginForm()
    {
        return view('guest.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), with(new LoginRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if (Auth::guard('users')->attempt([
            'email'     => $request->get('email'),
            'password'  => $request->get('password')
        ])) {
            $request->session()->regenerate();
            return redirect('/cabinet');
        }

        return redirect()->back()->withInput($request->all())->withErrors(['password' => ['Incorrect password']]);
    }

    public function registerForm($token = null)
    {
        return view('guest.register', ['token' => $token]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), with(new RegisterRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $refferal_id = null;
        if ($request->get('token')) {
            $ref = User::where('ref_link', $request->get('token'))->first();
            if (!empty($ref->id)) {
                $refferal_id = $ref->id;
            }
        }

        User::create([
            'login'         => $request->get('login'),
            'email'         => $request->get('email'),
            'password'      => Hash::make($request->get('password')),
            'role'          => 1,
            'balance'       => 0,
            'ref_link'      => str_replace(' ','',md5(uniqid()) . microtime()),
            'refferal_id'   => $refferal_id,
            'last_activity' => Carbon::now(),
        ]);


        Auth::guard('users')->attempt([
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
        return Auth::guard();
    }
}
