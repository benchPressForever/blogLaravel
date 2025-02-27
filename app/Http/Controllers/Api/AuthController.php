<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:8|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => "Validation Error",
                'data' => $validator->errors(),
            ];

            return response()->json($response, 400);
        }


       if(Auth::attempt($request->only('email', 'password'))) {
           $authUser = (object)Auth::user();

           return new AuthResource((object)[
               'token' => $authUser->createToken('authToken')->plainTextToken,
               'user' => $authUser,
           ]);
       }
       else{
           return response()->json([
               'success' => false,
               'message' => 'Invalid Email or Password',
           ],401);
       }
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => "Validation Error",
                'data' => $validator->errors(),
            ];

            return response()->json($response, 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $response = [
            'success' => true,
            'message' => "Пользователь успешно создан!",
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ];

        return response()->json($response , 200);


    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        $response = [
            'success' => true,
            'message' => 'Пользователь успешно вышел!'
        ];

        return response()->json($response, 200);

    }
}
