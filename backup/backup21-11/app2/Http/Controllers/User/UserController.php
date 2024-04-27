<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Auth;
use URL;
use Mail;
use PDF;

class UserController extends Controller
{
    public function UserCreate(Request $request)
    {

        $all_role = Role::all();


        return view('appPages.Users.userCreation', compact('all_role'));
    }

    public function userlist()
    {

        $all_user = User::
            where('is_delete', '0')
        ->get();

        // return $all_user;

        return view('appPages.Users.user-list',compact('all_user'));
    }

    public function UserCreateAction(Request $request)
    {


        $general_details = DB::table('settings')->first();
        $request->validate([
            'name' => "required|",
            'email' => 'required|unique:users',
            'password' => "required|min:8",
            'role' => "required|",
            'phone_no' => "required|min:10",
        ]);


        // try {

        // DB::beginTransaction();

        if ($request->profile_image != null) {

            $file = $request->file('profile_image');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("public/profile_picture/", $filename);
        } else {
            $filename = "no-image-available.png";
        }
        //  dd($filename);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no,
            'role_as' => $request->role,
            'profile_image' => $filename,

        ]);

        $user->assignRole($request->role);

        /*=================================Mail function=========================*/
        // $software_link = URL::to('/');
        // $email_id = $request->email;
        // $password = $request->password;
        // $name = $request->name;

        // Mail::to($email_id)->send(new MyDemoMail($name,$software_link,$email_id,$password));

        // Mail::send('mail.user-credential', ['name' => $name, 'software_link' => $software_link, 'email_id' => $email_id, 'password' => $password], function ($message) use ($general_details, $email_id) {
        //     $message->from($general_details->email);
        //     $message->to($email_id);
        //     $message->subject('User Generation');
        // });
        /*=======================================================================*/

        return redirect()->route('user-list')->with('success', 'User Created Sucessfully');

        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('UserCreate')->with('error',$th->getMessage());
        // }
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

    public function user_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);

        $user_details = User::find($u_id);

        $all_role = Role::all();

        return view('appPages.Users.edit-user', compact('user_details', 'all_role'));
    }

    public function user_update(Request $request)
    {
        $request->validate([
            'name' => "required|",
            'phone_no' => "required|",
        ]);

        // try {

        //     DB::beginTransaction();

        if ($request->hasfile('profile_image')) {

            $file = $request->file('profile_image');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("public/profile_picture/", $filename);
        } else {
            $filename = Auth::user()->profile_image;
        }

        $user = User::where('id', $request->id)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'role_as' => $request->role,
            'profile_image' => $filename,
        ]);

        $insertId = $user->id;

        DB::commit();
        return redirect()->route('user-list')->with('success', 'User Updated Sucessfully');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }
}
