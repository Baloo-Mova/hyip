<?php

namespace App\Http\Controllers;

use App\Models\PassportData;
use App\Models\PassportScans;
use App\Models\UserConfirm;
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
        $social = SocialNetwork::where(['is_active' => 1])->get();
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
                $origext  = $scan->getClientOriginalExtension();
                $filename = generate_file_name(".{$origext}");
                \Storage::disk('uploads')->put("scans/$filename", file_get_contents($scan->getRealPath()));

                \Image::make($scan->getRealPath())
                    ->resize(300, 200)
                    ->save(storage_path('/media/uploads/scans') . '/prev-' . $filename, 60);

                $scans[] = [
                    'user_id' => \Auth::user()->id,
                    'photo' => $filename,
                    'preview' => 'prev-' . $filename
                ];
            }
            PassportScans::insert($scans);
        }

        $confirm = new UserConfirm();
        $confirm->user_id = \Auth::user()->id;
        $confirm->save();

        $user = \Auth::user();
        $user->is_confirm = 0;
        $user->confirmed_date = Carbon::now();
        $user->save();

        Session::flash('messages', [__("messages.changes_successfully_controller")]);
        return back();

    }

}
