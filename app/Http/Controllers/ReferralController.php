<?php

namespace App\Http\Controllers;

use App\Models\Referrals;
use App\Models\Subscription;
use App\Models\User;
use App\Models\SocialNetwork;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class ReferralController extends Controller
{
    public function index()
    {
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];

        $ref = Referrals::select(DB::raw('level, count(id) as count, sum(earned) as sum'))
            ->where(['user_id' => Auth::id()])
            ->groupBy('level')
            ->get();
        $r = Referrals::all();
        $sum_all = 0;
        if(!isset($ref)){
            $sum_all = 0;
        }else{
            foreach ($ref as $r){
                $sum_all += $r->sum;
            }
        }

        $count = Referrals::where(['user_id' => Auth::id()])->count();
        $referrals = Referrals::where(['user_id' => Auth::id()])->paginate(15);

        return view('cabinet.referrals.index', [
            'referrals' => $referrals,
            'info' => $ref,
            'count' => $count,
            'data' => $data,
            'sum_all' => $sum_all
        ]);
    }

    private function getReferrals($ref_id, $users)
    {
        $referrals = [];

        foreach ($users as $user) {
            if ($user->referral_id == $ref_id) {
                $referrals[] = [
                    'id' => $user->id,
                    'login' => $user->login,
                    'referral_id' => $user->referral_id,
                    'last_activity' => $user->last_activity,
                ];
                foreach ($this->getReferrals($user->id, $users) as $item) {
                    $referrals[] = $item;
                }
            }
        }

        return $referrals;
    }

    public function search(Request $request)
    {
        $where = ['user_id' => \Auth::id()];

        if($request->has('level')){
            $where[] = ['level', '=', $request->get('level')];
            $search['level'] = $request->get('level');
        }

        if($request->has('user_ref_name')){
            $where[] = ['user_ref_name', 'like', '%'.$request->get('user_ref_name').'%'];
            $search['user_ref_name'] = $request->get('user_ref_name');
        }

        if($request->has('user_ref_phone')){
            $where[] = ['user_ref_phone', 'like', '%'.$request->get('user_ref_phone').'%'];
            $search['user_ref_phone'] = $request->get('user_ref_phone');
        }

        $daterange = $request->get('date_range');
        if (isset($daterange)) {
            $find = stripos($daterange, ' -');
            $date_from = \Carbon\Carbon::parse(substr($daterange, 0, $find))->toDateTimeString();
            $date_to = \Carbon\Carbon::parse(substr($daterange, $find + 3))->toDateTimeString();

            $referrals = Referrals::where($where)->whereBetween('created_at', [$date_from, $date_to])->paginate(15);

        }else{
            $referrals = Referrals::where($where)->paginate(15);
        }
        $sum_all = 0;
        if(!isset($ref)){
            $sum_all = 0;
        }else{
            foreach ($ref as $r){
                $sum_all += $r->sum;
            }
        }

        $social = SocialNetwork::where(['is_active' => 1])->get();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];

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

        $count = Referrals::where(['user_id' => Auth::id()])->count();

        $search['date_range'] = $request->get('date_range');

        return view('cabinet.referrals.index', [
            'referrals' => $referrals,
            'info' => $ref,
            'count' => $count,
            'search' => $search,
            'data' => $data,
            'sum_all' => $sum_all
        ]);


    }
}