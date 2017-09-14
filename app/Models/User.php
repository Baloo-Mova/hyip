<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $role
 * @property float $balance
 * @property string|null $phone
 * @property int|null $subscribe_id
 * @property string|null $subscribedFor
 * @property int|null $referral_id
 * @property string $ref_link
 * @property string|null $last_activity
 * @property int $is_banned
 * @property string|null $remember_token
 * @property string|null $auth_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $ip
 * @property int $ref_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\User $referrer
 * @property-read \App\Models\Subscription $subscription
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAuthToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRefCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRefLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereReferralId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSubscribeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSubscribedFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PassportScans[] $scans
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'role',
        'balance',
        'phone',
        'ref_link',
        'referral_id',
        'last_activity',
        'ip',
        'is_banned',
        'auth_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeActive()
    {
        return $this->where('is_banned', 0);
    }


    static function dialogs()
    {

        $id = \Auth::id();
        $key = md5('Dialogs_for_user_' . $id);
        \Cache::forget($key);
        return \Cache::rememberForever($key, function () use ($id) {
            $query = Message::select(\DB::raw('max(id) as id, from_user, to_user'))
                ->where(function ($query) use ($id) {

                    $query->where('from_user', $id)
                        ->where('from_delete', 0);

                })
                ->orWhere(function ($query) use ($id) {

                    $query->where('to_user', $id)
                        ->where('to_delete', 0);

                })
                ->groupBy('from_user', 'to_user')
                ->orderBy('id', 'desc')
                ->get();

            $dialogs = [];
            $exist_dialogs = [];
            $messages_id = [];

            foreach ($query as $dialog) {
                if (isset($exist_dialogs[$dialog->from_user]) && in_array($dialog->to_user, $exist_dialogs[$dialog->from_user])
                    || isset($exist_dialogs[$dialog->to_user]) && in_array($dialog->from_user, $exist_dialogs[$dialog->to_user])
                ) {
                    continue;

                } else {
                    $exist_dialogs[$dialog->from_user][] = $dialog->to_user;
                    $dialogs[] = $dialog;
                    $messages_id[] = $dialog->id;
                }
            }

            return Message::whereIn('id', $messages_id)
                ->orderBy('id', 'desc')
                ->get();
        });
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscribe_id');
    }

    public function referrer()
    {
        return $this->hasOne(User::class, 'id', 'referral_id');
    }

    public function addReferr()
    {
        $this->increment('ref_count');
        $this->save();
    }


    public function scans()
    {
        return $this->hasMany(PassportScans::class, 'user_id', 'id');
    }

    public function createPassportData()
    {
        return PassportData::createDefault($this->id);
    }

    public function incrementReferrers()
    {
        $user = $this;
        while (true) {

            if (!isset($user->referral_id)) {
                return;
            }

            $ref = $user->referrer;
            if (!isset($ref)) {
                return;
            }

            $ref->addReferr();
            $user = $ref;
        }
    }

    public function prices()
    {
        return $this->hasMany(SubscriptionPrice::class, 'subscription_id', 'subscribe_id');
    }

    public function payToReferrals(Subscription $subscription)
    {
        $prices = $subscription->prices;
        if ($this->referral_id == null) {
            return;
        }

        $iterator = 0;
        $userToPay = $this->referrer;

        while (true) {
            if (!isset($userToPay)) {
                break;
            }
            if ($iterator > count($prices)) {
                break;
            }

            if (!isset($userToPay->subscribe_id)) {
                $userToPay = $userToPay->referrer;
                continue;
            }
            $priceNow = $this->findPriceByLevel($iterator, $userToPay->prices);
            if (isset($priceNow)) {
                $toIncrement = $priceNow->is_percent ? ($subscription->price * $priceNow->value) / 100 : $priceNow->value;
                WalletProcesses::insert([
                    'wallet_id' => 0,
                    'type_id' => WalletProcessesType::REFERRAL,
                    'time' => Carbon::now(),
                    'value' => $toIncrement,
                    'from_id' => $this->id,
                ]);
                $userToPay->increment('balance', $toIncrement);
                $userToPay->save();
            }

            $userToPay = $userToPay->referrer;
            $iterator++;
        }
    }

    /**
     * @param $level
     * @param $prices SubscriptionPrice
     * @return SubscriptionPrice
     */
    private function findPriceByLevel($level, $prices)
    {
        foreach ($prices as $price) {
            if ($price->level == $level) {
                return $price;
            }
        }
        return null;
    }

    public function passportData()
    {
        return $this->hasOne(PassportData::class, 'user_id', 'id');
    }
}
