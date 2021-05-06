<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Status code - User POV - Admin POV:
// o11 - [show in 'Yours - Groupbuy'] - Order pending
// o12 - [show in 'To Pay'] - Pending payment
// o13 - [show in 'Processing'] - Paid
// o14 - [show in 'To Receive'] - Shipping
// o15 - [show in 'View History'] - Order complete
// o21 - [show in 'Cancelled'] - Cancelled
// o22 - [show in 'Cancelled'] - Refunded

class Order extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'groupbuy_id'
        , 'product_id'
        , 'user_id'
        , 'status'
        , 'quantity'
        , 'confirmedPrice'
        , 'shipping_streetaddress'
        , 'shipping_city'
        , 'shipping_postalcode'
        , 'payment_id'
        , 'is_delivered'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function groupbuy()
    {
        return $this->belongsTo(Groupbuy::class, 'groupbuy_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
