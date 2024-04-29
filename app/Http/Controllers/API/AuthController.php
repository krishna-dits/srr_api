<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return response()->json(['success' => 1, 'user' => $user], 200);
    }


    public function update_user(Request $request)
    {
        try {

            $user = User::where('id', $request->id)->first();

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

            return response()->json(['success' => 1, 'message' => 'User Updated Sucessfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'message' => 'Internal server errors.'], 500);
        }
    }
}
