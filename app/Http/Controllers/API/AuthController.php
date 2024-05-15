<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // POST api/login
    public function loginUser(Request $request)
    {
        try {
            $data = User::where('email', $request->email)->first();

            if (empty($data)) {
                return response()->json(['success' => 0, 'message' => 'Credential not match.'], 400);
            }

            if (Auth::attempt($request->except('_token'))) {
                return response()->json([
                    'success' => 1, 'userInfo' => ['id' => $data->id, 'name' => $data->name, 'email' => $data->email, 'role' => $data->role_as], 'token' => $data->createToken("API TOKEN")->plainTextToken
                ], 200);
            } else {
                return response()->json(['success' => 0, 'message' => 'Credential not match.'], 400);
            }
        } catch (\Exception $th) {
            return response()->json(['success' => 0, 'message' => 'Internal server errors.'], 500);
        }
    }

    // POST api/logout
    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->tokens()->delete();
        return response()->json(['success' => 1, 'message' => 'Logout successful.'], 200);
    }


    public function user_data()
    {
        $user = User::where('id', Auth::id())->first();
        $user = new UserResource($user);
        return response()->json(['success' => 1, 'user' => $user], 200);
    }


    public function update_user(Request $request)
    {
        try {

            $user = User::where('id', $request->user_id)->first();

            if (empty($user)) {
                return response()->json(['success' => 0, 'message' => 'User not found.'], 500);
            }

            if ($request->hasfile('profile_image')) {
                $file = $request->file('profile_image');
                $filename = rand() . '.' . $file->getClientOriginalExtension();
                $file->move("public/profile_picture/", $filename);
            } else {
                $filename = $user->profile_image;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_no = $request->phone;
            $user->profile_image = $filename;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->present_address = $request->present_address;
            $user->marital_status = $request->marital_status;
            $user->update();

            $user = new UserResource($user);

            return response()->json(['success' => 1, 'message' => 'User Updated Sucessfully', 'data' => $user], 200);
        } catch (\Throwable $th) {
            return $th;
            return response()->json(['success' => 0, 'message' => 'Internal server errors.'], 500);
        }
    }


    public function forget_password(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if (empty($user)) {
            return response()->json(['success' => 0, 'message' => 'Please enter valid email.'], 200);
        }

        $token = md5(mt_rand(111111, 999999));

        cache()->remember($token, 6000, function () use ($user) {
            return $user->email;
        });

        $email_id = $user->email;
        Mail::send('emails.forget_pass', [
            'reset_url' => url('password-reset-url') . '/' . $token
        ], function ($message) use ($email_id) {
            $message->from('noreply.srrmail@gmail.com');
            $message->to($email_id);
            $message->subject("Password reset link.");
        });

        return response()->json(['success' => 1, 'message' => 'Password reset link send to the email.'], 200);
    }
}
