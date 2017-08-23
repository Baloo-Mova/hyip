<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionPrice;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    private $_model;
    private $_view = 'users';

    public function __construct(User $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function index()
    {
        $referrals  = [];
        $levels     = [];
        $users      = User::all();

        foreach ($users as $user) {
            $count = get_referrals_count($user->id, $users);
            if (!empty($referrals[$count])) {
                $referrals[$count] = $referrals[$count] + 1;
            } else {
                $referrals[$count] = 1;
            }

            $level = get_referral_level($user->id, $users);
            foreach ($level as $key => $item) {
                if (!empty($levels[$key])) {
                    $levels[$key] = $levels[$key] + $item;
                } else {
                    $levels[$key] = $item;
                }

            }
        }
        unset($referrals[0]);
        ksort($referrals);

        return view('Admin::' . $this->_view . '.list', [
            'referrals' => $referrals,
            'levels'    => $levels
        ]);
    }


}