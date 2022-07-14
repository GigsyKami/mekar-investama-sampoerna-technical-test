<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WalletController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    public function index()
    {
        $d['users'] = User::where('id', '!=', Auth::id())->get();
        $html = view('content.transfer', $d)->render();
        return $this->responseBase($html);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to_user_id' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->failResponse("validation data invalid.", $validator->errors());
        }

        if (Auth::user()->wallet->balance < $request->amount) {
            return $this->failResponse("Saldo tidak cukup.");
        }
        try {
            $wallet = new WalletController;
            $deposit = $wallet->transfer(Auth::id(), $request->amount, $request->to_user_id);
            return $this->responseBase(null, 'Success Transfer');
        } catch (\Throwable $th) {
            return $this->failResponse($th->getMessage());
        }
    }
}
