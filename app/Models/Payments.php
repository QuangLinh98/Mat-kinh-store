<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments'; // Change this to 'payment' if your table is named 'payment'
    protected $primaryKey = 'transId';
    protected $fillable = [
        'partnerCode',
        'accessKey',
        'requestId',
        'amount',
        'orderId',
        'orderInfo',
        'orderType',
        'transId',
        'localMessage',
        'responseTime',
        'payType',
        'signature',
    ];
    public $timestamps = false; // Disable timestamps
}
