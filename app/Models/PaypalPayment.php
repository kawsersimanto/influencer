<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalPayment extends Model
{
    use HasFactory;

    public function currency(){
        return $this->belongsTo(MultiCurrency::class);
    }
}
