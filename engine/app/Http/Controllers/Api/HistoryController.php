<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $d['transactions'] = Transaction::where('from_wallet_id', Auth::user()->wallet->id)->orWhere('to_wallet_id', Auth::user()->wallet->id)->get();
        $html = view('content.history', $d)->render();
        return $this->responseBase($html);
    }
}
