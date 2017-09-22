<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Users;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\SubmitEmail;
use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\Request;
use Faker\Generator;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('guest.login');
    }

    public function resetPasswordForm()
    {
        return view('guest.reset');
    }

    public function resetSend(Request $request)
    {
        $email = $request->get('email');
        if(!isset($email)){
            return redirect(route('password.reset'))
                ->withErrors([__("messages.specify_email")]);
        }
        $user = User::where('email', '=', $email)->first();
        if(!isset($user)){
            return redirect(route('password.reset'))
                ->withErrors([__("messages.user_email_dont_exist")]);
        }

        $token = uniqid();

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => bcrypt($token),
            'created_at' => Carbon::now()
        ]);

        $url = url("/password/reset/t/" . $token);

        $text = __("messages.hello").", ".$user->login." ! ".__("messages.recovery_email_text").": ".$url;

        try {
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = env("MAIL_HOST");
            $mail->SMTPAuth = true;
            $mail->Username = env("MAIL_USERNAME");
            $mail->Password = env("MAIL_PASSWORD");
            $mail->SMTPSecure = 'ssl';
            $mail->Port = env("MAIL_PORT");
            $mail->CharSet = 'UTF-8';
            $mail->setFrom(env("NO_REPLY_EMAIL"));
            $mail->addAddress($email);

            $mail->Subject = __("messages.password_recovery");
            $mail->Body = $text;
            if(preg_match("/<[^<]+>/", $text, $m) != 0){
                $mail->IsHTML(true);
            }

            $mail->send();
        } catch (\Exception $ex) {
            return redirect(route('password.reset'))
                ->withErrors([__("messages.error")]);
        }

        Session::flash('messages', [__("messages.instructions_sent")]);
        return redirect()->route('password.reset');
    }

    public function checkToken($token)
    {
        return view('guest.change', ['token' => $token]);
    }

    public function resetSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required',
            'passw' => 'required',
            'passw2' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('password.reset.check', ['token' => $request->get('token')]))
                ->withErrors($validator);
        }

        $token = $request->get('token');
        $email = $request->get('email');
        $passw = $request->get('passw');
        $passw2 = $request->get('passw2');

        if($passw != $passw2){
            return redirect(route('password.reset.check', ['token' => $request->get('token')]))
                ->withErrors([__("messages.passwords_dont_match")]);
        }

        $check = PasswordResets::where(['email' => $email])->first();

        if(!isset($check)){
            return redirect(route('password.reset.check', ['token' => $request->get('token')]))
                ->withErrors([__("messages.user_email_dont_exist")]);
        }

        $user = User::where(['email' => $email])->first();

        if(!isset($user)){
            return redirect(route('password.reset.check', ['token' => $request->get('token')]))
                ->withErrors([__("messages.user_email_dont_exist")]);
        }

        if(!Hash::check($token, $check->token)){
            return redirect(route('password.reset.check', ['token' => $request->get('token')]))
                ->withErrors([__("messages.error_token")]);
        }

        $check->delete();
        $user->password = bcrypt($passw);
        $user->save();

        Session::flash('messages', [__("messages.password_changed")]);
        return redirect()->route('login');

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
                $user->update([
                    'last_activity' => Carbon::now(),
                    'auth_token' => str_random(32)
                ]);
                $request->session()->regenerate();
                return redirect($redirect);
            }
        }


        return redirect()->back()->withInput($request->all())->withErrors(['password' => [__("messages.incorrect_password")]]);
    }

    public function registerForm(Request $request)
    {
        $count = User::where('ip', '=', $request->ip())->count();
        if ($count > 0) {
            return view('guest.register', ['user' => null])->withErrors(['userWithIpExist' => $request->ip()]);
        }


        $user = User::find($request->cookie('referralId'));

        return view('guest.register', ['user' => $user]);
    }

    public function register(RegisterRequest $request)
    {

        $validator = \Validator::make($request->all(), with(new RegisterRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $referral_id = null;
        if ($request->get('token')) {
            $ref = User::where('ref_link', $request->get('token'))->first();
            if (isset($ref)) {
                $referral_id = $ref->id;
            }
        }

        $gen = Factory::create();
        $gen->seed(microtime(true));


        $user = User::create([
            'login' => $request->get('login'),
            'ip' => $request->ip(),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'password' => \Hash::make($request->get('password')),
            'role' => 1,
            'ref_count' => 0,
            'balance' => 0,
            'status' => 0,
            'ref_link' => $gen->uuid,
            'referral_id' => $referral_id,
            'last_activity' => Carbon::now(),
        ]);


        $user->createPassportData();

        Mail::to($user->email)
            ->send(new SubmitEmail($user));

        if (isset($referral_id)) {
            $user->incrementReferrers();
        }

        \Auth::guard('users')->attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);

        return redirect()->route('cabinet');
    }

    public function submitEmail($id, $token)
    {
        $user = User::find($id);
        if (isset($user) && md5($user->email) == $token) {
            if ($user->status == 0) {

                $user->status = 1;
                $user->save();

                \Session::flash('messages', [__("messages.email_is_verified")]);

            }
        }

        $to = \Auth::check() ? 'cabinet' : 'index';

        return redirect(route($to));
    }

    public function logout(Request $request)
    {
        if ($user = $this->guard()->user()) {
            $user->update([
                'auth_token' => null
            ]);
        };
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    protected function guard()
    {
        return \Auth::guard();
    }
}
