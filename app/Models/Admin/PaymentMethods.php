<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentMethods extends Model
{
    protected $table = 'payment_methods';
    protected $primaryKey = 'payment_method_id';
    
    public static function getPaymentMethods()
    {
        $payment_methods = self::all();

        return $payment_methods;
    }
}
