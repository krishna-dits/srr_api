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
            $validate =  Validator::make($request->all(), [
                'email'     => 'required|email',
                'password'  => 'required|',
            ]);

            if ($validate->fails()) {
                $errors = $validate->errors();
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $errors
                ], 400);
            }

            $data = User::where('email', $request->email)->first();

            if (empty($data)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Credential not match.',
                    'errors' => ''
                ], 400);
            }

            if (Auth::attempt($request->except('_token'))) {
                return response()->json([
                    'status' => true,
                    'userInfo' => ['name' => $data->name, 'email' => $data->email],
                    'token' => $data->createToken("API TOKEN")->plainTextToken
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Credential not match.',
                    'errors' => ''
                ], 400);
            }
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'message' => 'Internal server error.',
                'errors' => $th->getMessage(),
            ], 500);
        }
    }

    // POST api/logout
    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'User Logout',
            'errors' => ''
        ], 200);
    }


    public function user_data()
    {
        try {
            $user = User::where('id', Auth::id())->first();
            return response()->json([
                'status' => true,
                'message' => 'User Logout',
                'data' => $user
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'message' => 'Internal server error.',
                'errors' => $th->getMessage(),
            ], 500);
        }
    }
}
