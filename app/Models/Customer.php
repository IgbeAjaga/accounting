<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'name',
        'email',
        'phone',
        'old_balance',
        'new_balance',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_number', 'account_number');
    }
}
