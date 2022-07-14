<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        $html = view('content.register')->render();
        return $this->responseBase($html);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name'  => 'required',
            'password'  => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return $this->failResponse("validation data invalid.", $validator->errors());
        }

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $wallet = new Wallet();
            $wallet->user_id = $user->id;
            $wallet->balance = 0;
            $wallet->save();

            Auth::login($user);
            $access_token =  $user->createToken(env('APP_NAME'))->plainTextToken;

            return $this->responseBase($access_token);
        } catch (\Throwable $th) {
            return $this->failResponse($th->getMessage());
        }
    }
}
