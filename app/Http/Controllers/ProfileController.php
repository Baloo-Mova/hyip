<?php

namespace App\Http\Controllers;

use App\Models\PassportData;
use App\Models\PassportScans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\SocialNetwork;

class ProfileController extends Controller
{

    public function index()
    {
        $user = \Auth::user();
        $passportData = PassportData::where('user_id', '=', $user->id)->first();
        $scans = $user->scans;
        $social = SocialNetwork::all();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];

        if (!isset($passportData)) {
            $passportData = $user->createPassportData();
        }

        return view('cabinet.profile.index', [
            'user' => $user,
            'passport_data' => $passportData->dataToArray(),
            'data' => $data,
            'scans' => isset($scans) ? $scans : ""
        ]);
    }

    public function edit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'middleName' => 'required',
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
        $pd['middleName'] = $request->get('middleName');
        $pd['series'] = $request->get('series');
        $pd['number'] = $request->get('number');
        $pd['issuedby'] = $request->get('issuedby');
        $pd['dateofissue'] = Carbon::parse($request->get('dateofissue'))->toDateTimeString();
        $pd['is_confirm'] = $request->get('is_confirm');

        $passportData = PassportData::where('user_id', '=', \Auth::user()->id)->first();
        if (!isset($passportData)) {
            $passportData = new PassportData();
            $passportData->user_id = \Auth::user()->id;
            $passportData->passport_data = json_encode($pd);
            $passportData->save();
        } else {
            $passportData->passport_data = json_encode($pd);
            $passportData->save();
        }

        if ($request->hasFile('scans')) {
            $scans = [];
            foreach ($request->file('scans') as $scan) {
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
