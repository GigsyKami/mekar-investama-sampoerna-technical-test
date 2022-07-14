<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function wallet($user_id)
    {
        $wallet = Wallet::where('user_id', $user_id)->first();
        if ($wallet == null) {
            $wallet = new Wallet();
            $wallet->user_id = $user_id;
            $wallet->balance = 0;
            $wallet->save();
        }

        return $wallet;
    }

    public function topUp($user_id, $amount)
    {
        // tambah amount di user wallet
        $wallet = $this->wallet($user_id);
        $wallet->balance += $amount;
        $wallet->save();

        $transaction = new Transaction();
        $transaction->to_wallet_id = $wallet->id;
        $transaction->amount = $amount;
        $transaction->save();

        return $transaction;
    }

    public function transfer($from_user_id, $amount, $to_user_id)
    {
        // kurangi amount dari sumber wallet
        $from_wallet = $this->wallet($from_user_id);
        $from_wallet->balance -= $amount;
        $from_wallet->save();

        // tambah amount dari tujuan wallet
        $to_wallet = $this->wallet($to_user_id);
        $to_wallet->balance += $amount;
        $to_wallet->save();

        $transaction = new Transaction();
        $transaction->from_wallet_id = $from_wallet->id;
        $transaction->to_wallet_id = $to_wallet->id;
        $transaction->amount = $amount;
        $transaction->save();

        return $transaction;
    }
}
