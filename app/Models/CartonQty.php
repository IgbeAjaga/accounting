<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartonQty extends Model
{
    use HasFactory;

    protected $table = 'cartonqty'; 

    protected $fillable = [
        'oldqty',
        'kg', 
        'qtybal', 
        'oldamount', 
        'currentamount', 
        'amountbal', 
        'transactiontype',
    ];
}
