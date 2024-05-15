<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Auth;
use Illuminate\Support\Facades\Cache;
use URL;
use Mail;
use PDF;

class UserController extends Controller
{
    // GET /User-add
    public function UserCreate(Request $request)
    {
        $all_role = Role::all();
        return view('appPages.Users.userCreation', compact('all_role'));
    }


    // GET /User-add
    public function userlist()
    {
        $all_user = User::get();
        return view('appPages.Users.user-list', compact('all_user'));
    }


    // POST /User-add
    public function UserCreateAction(Request $request)
    {
        // $general_details = DB::table('settings')->first();

        $request->validate([
            'name'              => "required|",
            'email'             => 'required|unique:users',
            'password'          => "required|min:8",
            'role'              => "required|",
            'phone_no'          => "required|min:10",
            'designation'       => 'required',
            'gender'            => 'required',
            'dob'               => 'nullable',
            'date_of_joining'   => 'nullable',
            'guardian_name'     => 'nullable',
            'marital_status'    => 'nullable',
        ]);

        if ($request->profile_image != null) {
            $file = $request->file('profile_image');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("public/profile_picture/", $filename);
        } else {
            $filename = "no-image-available.png";
        }

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'phone_no'          => $request->phone_no,
            'role_as'           => $request->role,
            'profile_image'     => $filename,
            'designation'       => $request->designation,
            'dob'               => $request->dob,
            'gender'            => $request->gender,
            'date_of_joining'   => $request->date_of_joining,
            'guardian_name'     => $request->guardian_name,
            'marital_status'    => $request->marital_status,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('user-list')->with('success', 'User Created Sucessfully');
    }


    // GET /user-edit/{user_id}
    public function user_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);
        $user_details = User::find($u_id);
        $all_role = Role::all();

        return view('appPages.Users.edit-user', compact('user_details', 'all_role'));
    }


    // POST /user-edit/{user_id}
    public function user_update(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $request->validate([
            'name'              => "required",
            'phone_no'          => "required",
            'gender'            => 'required',
            'designation'       => 'required',
            'dob'               => 'nullable',
            'date_of_joining'   => 'nullable',
            'guardian_name'     => 'nullable',
            'marital_status'    => 'nullable',
        ]);

        if ($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("public/profile_picture/", $filename);
        } else {
            $filename = $user->profile_image;
        }

        $user->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone_no'          => $request->phone_no,
            'profile_image'     => $filename,
            'designation'       => $request->designation,
            'dob'               => $request->dob,
            'gender'            => $request->gender,
            'date_of_joining'   => $request->date_of_joining,
            'guardian_name'     => $request->guardian_name,
            'marital_status'    => $request->marital_status,
        ]);

        DB::commit();
        return redirect()->route('user-list')->with('success', 'User Updated Sucessfully');
    }


    public function userprofile($id)
    {
        $user_id = base64_decode($id);
        $login_details = User::with('roles')->where('id', $user_id)->first();

        return view('appPages.Users.user-details', compact('login_details'));
    }

    public function user_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = User::find($u_id);
            $user->is_delete = '1';
            $user->is_active = '0';
            $user->save();
            DB::commit();
            return redirect()->route('user-list')->with('success', 'User Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('user-list')->with('error', $th->getMessage());
        }
    }
    public function user_enable_disable($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = User::find($u_id);
            if ($user->is_active == '0') {
                $user->is_active = '1';
                $user->save();
                DB::commit();
                return redirect()->route('user-list')->with('success', 'User Enable Sucessfully');
            } else {
                $user->is_active = '0';
                $user->save();
                DB::commit();
                return redirect()->route('user-list')->with('error', 'User Disable Sucessfully');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('user-list')->with('error', $th->getMessage());
        }
    }

    public function change_password()
    {
        return view('appPages.Users.change-password');
    }
    public function save_change_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required',
        ]);
        $hashedPassword = Auth::user()->password;

        if (\Hash::check($request->old_password, $hashedPassword)) {
            if (!\Hash::check($request->new_password, $hashedPassword)) {
                if ($request->new_password == $request->confirm_password) {

                    $users = User::find(Auth::id());
                    $users->password = Hash::make($request->new_password);
                    $users->save();

                    session()->flash('success', 'Password updated successfully!');
                    return redirect('user-profile/' . base64_encode(Auth::id()));
                } else {
                    session()->flash('error', 'New password does not matched with Confirm password!');
                    return redirect()->back();
                }
            } else {
                session()->flash('error', 'New password can not be the old password!');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Old password does not matched! ');
            return redirect()->back();
        }
    }


    public function password_reset(Request $request, $token)
    {
        $value = cache($token);
        if (empty($value)) {
            return "This password reset link expired.";
        }

        $user = User::whereEmail(cache($token))->first();
        if (empty($user)) {
            return "Invalid user.";
        }

        if (Request()->isMethod('POST')) {
            $request->validate([
                'new_password'              => 'required',
                'confirm_password'          => 'required|same:new_password',
            ]);

            $user->password = Hash::make($request->new_password);
            $user->update();
            Cache::forget($token);
            return view('auth.forget_pass_done');
        }
        return view('auth.forget_pass');
    }
}
