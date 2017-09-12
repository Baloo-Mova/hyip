<?php

namespace App\Http\Controllers;

use App\Models\PassportData;
use App\Models\PassportScans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index()
    {
        $user = \Auth::user();
        $passportData = PassportData::where('user_id', '=', $user->id)->first();
        $scans = $user->scans;
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('cabinet.profile.index', [
            'user' => $user,
            'passport_data' => isset($passportData) ? json_decode($passportData->passport_data) : "",
            'data' => $data,
            'scans' => isset($scans) ? $scans : ""
        ]);
    }

    public function edit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'firdname' => 'required',
            'series' => 'required',
            'number' => 'required',
            'issuedby' => 'required',
            'dateofissue' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('profile'))
                ->withErrors($validator)
                ->withInput();
        }

        $pd = [];
        $pd['name'] = $request->get('name');
        $pd['surname'] = $request->get('surname');
        $pd['firdname'] = $request->get('firdname');
        $pd['series'] = $request->get('series');
        $pd['number'] = $request->get('number');
        $pd['issuedby'] = $request->get('issuedby');
        $pd['dateofissue'] = Carbon::parse($request->get('dateofissue'))->toDateTimeString();
        $pd['is_confirm'] = $request->get('is_confirm');

        $passportData = PassportData::where('user_id', '=', \Auth::user()->id)->first();
        if(!isset($passportData)){
            $passportData = new PassportData();
            $passportData->user_id = \Auth::user()->id;
            $passportData->passport_data = json_encode($pd);
            $passportData->save();
        }else{
            $passportData->passport_data = json_encode($pd);
            $passportData->save();
        }

        if ($request->hasFile('scans')) {
            $scans = [];
            foreach ($request->file('scans') as $scan){
                $path = $scan->store('scans', 'public');
                $scans[] = [
                    'user_id' => \Auth::user()->id,
                    'path' => $path
                ];
            }
            PassportScans::insert($scans);
        }

        Session::flash('messages', ['Изменения успешно внесены!']);
        return back();

    }

}
