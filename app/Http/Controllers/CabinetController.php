<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cabinet\UserUpdateRequest;
use App\Models\User;
use App\Models\WalletProcesses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SocialNetwork;
use App\Models\Referrals;
use Illuminate\Support\Facades\DB;

use Auth, Validator;

class CabinetController extends Controller
{
    public function index(Request $request)
    {
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $count = Referrals::where(['user_id' => Auth::id()])->count();
        $ref = Referrals::select(DB::raw('level, count(id) as count, sum(earned) as sum'))
            ->where(['user_id' => Auth::id()])
            ->groupBy('level')
            ->get();
        $sum_all = 0;
        if(!isset($ref)){
            $sum_all = 0;
        }else{
            foreach ($ref as $r){
                $sum_all += $r->sum;
            }
        }
        $sum_out = WalletProcesses::where(['from_id' => \Auth::id(), 'status' => 0])->first();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];

        $response = view('cabinet.index', [
            'user' => \Auth::user(),
            'data' => $data,
            'count' => $count,
            'info' => $ref,
            'sum_all' => $sum_all,
            'sum_out' => isset($sum_out) ? $sum_out->value : 0,
            'payedForDiff' =>Carbon::now()->diff(Carbon::parse(Auth::user()->subscribedFor))
        ]);

        if (Auth::user()->status == 0) {
            $response = $response->withErrors(['email' => __("messages.email_not_verified")]);
        }
        
        return $response;
    }

    public function userUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), with(new UserUpdateRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();

        if ($request->file('photo')) {
            $path = $request->file('photo')->getPath();
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            Passport::create([
                'user_id' => $user_id,
                'img' => $base64,
            ]);
        }

        $user->update([
            'phone' => $request->get('phone'),
        ]);

        return redirect()->route('cabinet')
            ->with(['message' => trans('backend.create_success')]);
    }
}