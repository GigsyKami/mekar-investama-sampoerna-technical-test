<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TopUpController extends Controller
{
    public function index()
    {
        $html = view('content.top-up')->render();
        return $this->responseBase($html);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount'  => 'required',
        ]);

        if ($validator->fails()) {
            return $this->failResponse("validation data invalid.", $validator->errors());
        }
        try {
            $wallet = new WalletController;
            $deposit = $wallet->topUp(Auth::id(), $request->amount);
            return $this->responseBase(null, 'Success Topup');
        } catch (\Throwable $th) {
            return $this->failResponse($th->getMessage());
        }
    }
}
