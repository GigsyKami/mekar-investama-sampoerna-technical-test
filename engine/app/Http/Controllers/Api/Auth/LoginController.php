<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        $html = view('content.login')->render();
        return $this->responseBase($html);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'  => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return $this->failResponse("validation data invalid.", $validator->errors());
        }

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id());
            $access_token =  $user->createToken(env('APP_NAME'))->plainTextToken;
            return $this->responseBase($access_token, 'login success');
        } else {
            return $this->failResponse('Invalid email or password');
        }
    }

    public function logout(Request $request)
    {

        $user = User::find(Auth::id());
        $user->tokens()->delete();

        Auth::logout();
        return $this->responseBase(null, 'Logout success');
    }
}
