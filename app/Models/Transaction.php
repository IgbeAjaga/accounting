<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'amount',
        'transactiontype',
        'old_balance', // Add old_balance
        'new_balance', // Add new_balance
        'quantity',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
