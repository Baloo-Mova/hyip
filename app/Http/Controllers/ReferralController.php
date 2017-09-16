<?php

namespace App\Http\Controllers;

use App\Models\Referrals;
use App\Models\User;
use App\Models\SocialNetwork;

use Auth;

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

        $ref = Referrals::where(['user_id' => Auth::id()])->paginate(15);

        return view('cabinet.referrals.index', [
            'referrals' => $ref,
            'data' => $data
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
}