<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Users;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\Request;
use Faker\Generator;

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

        if ($user = User::where('email', $request->get('email'))->first()) {

            if ($user->is_banned) {
                return redirect()->back()->withInput($request->all())->withErrors(['user' => ['User is banned']]);
            }

            switch ($user->role) {
                case 1:
                    $guard = 'users';
                    $redirect = route('cabinet');
                    break;
                case 2:
                    $guard = 'admin';
                    $redirect = route('admin-dashboard');
                    break;
                default:
                    $guard = 'users';
                    $redirect = route('cabinet');
            }

            if (\Auth::guard($guard)->attempt([
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ])) {
                $request->session()->regenerate();
                return redirect($redirect);
            }
        }


        return redirect()->back()->withInput($request->all())->withErrors(['password' => ['Incorrect password']]);
    }

    public function registerForm(Request $request, $token = null)
    {
        $count = User::where('ip', '=', $request->ip())->count();
        if ($count > 0) {
            return view('guest.register', ['user' => null])->withErrors(['userWithIpExist' => $request->ip()]);
        }

        $user = User::where('ref_link', '=', $token)->first();

        return view('guest.register', ['user' => $user]);
    }

    public function register(RegisterRequest $request)
    {
        $referral_id = null;
        if ($request->get('token')) {
            $ref = User::where('ref_link', $request->get('token'))->first();
            if (isset($ref)) {
                $referral_id = $ref->id;
            }
        }

        $gen = Factory::create();
        $gen->seed(microtime(true));


        User::create([
            'login' => $request->get('login'),
            'ip' => $request->ip(),
            'email' => $request->get('email'),
            'password' => \Hash::make($request->get('password')),
            'role' => 1,
            'balance' => 0,
            'ref_link' => $gen->uuid,
            'referral_id' => $referral_id,
            'last_activity' => Carbon::now(),
        ]);


        \Auth::guard('users')->attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);

        return redirect()->route('cabinet');
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
