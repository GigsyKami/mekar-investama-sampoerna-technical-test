<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    function from()
    {
        return $this->belongsTo(Wallet::class, 'from_wallet_id');
    }

    function to()
    {
        return $this->belongsTo(Wallet::class, 'to_wallet_id');
    }
}
