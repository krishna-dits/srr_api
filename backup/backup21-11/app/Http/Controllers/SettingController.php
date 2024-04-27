<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\Setting;
use DB;
use App\Models\UserAttendanceLocation;
use Illuminate\Support\Carbon;

class SettingController extends Controller
{
    public function general_setting_details()
    {
        $general_details = Setting::first();
        // dd($general_details);
        return view('general_setting.general-setting', compact('general_details'));
    }

    public function save_general_setting(Request $req)
    {
        $validator = $req->validate([
            'name' => 'required',
        ]);
        $general_details = Setting::first();
        try {
            DB::beginTransaction();
            if ($req->hasfile('logo')) {
                $file = $req->file('logo');
                $filename = rand() . '.' . $file->getClientOriginalExtension();
                $file->move("public/assets/images/brand/", $filename);
            } else {
                $filename = $general_details->logo;
            }
            if ($req->hasfile('small_logo')) {
                $file = $req->file('small_logo');
                $filename_small_logo = rand() . '.' . $file->getClientOriginalExtension();
                $file->move("public/assets/images/brand/", $filename_small_logo);
            } else {
                $filename_small_logo = $general_details->small_logo;
            }

            $general_details = array(

                'software_name' => $req->name,
                'email' => $req->email,
                'address' => $req->address,
                'gst_no' => $req->gst_no,
                'phone_no' => $req->phone_no,
                'logo' => $filename,
                'small_logo' => $filename_small_logo,
                'puc_alert_days' => $req->puc_alert_days,

            );

            Setting::where('id', $req->id)->update($general_details);
            DB::commit();
            $req->session->flash('success', 'Setting Updated Successfully');
            return redirect('general-setting-details');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
