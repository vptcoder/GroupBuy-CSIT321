<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Status code - Admin POV:
// p11 - Pending payment
// p12 - Paid
// p21 - Cancelled

class Payment extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id'
        , 'user_id'
        , 'status'
        , 'transaction_id'
        , 'amount'
        , 'method'
		, 'date_due'
        , 'date_paid'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
