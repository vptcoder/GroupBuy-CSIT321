<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// p01 - Hidden - Hidden
// p11 - Available - Available

class Product extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'status'
        , 'name'
        , 'price'
        , 'description'
        , 'image'
        , 'min'
        , 'max'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function watchlists(){
        return $this->hasMany(Watchlist::class);
    }

    public function groupbuys(){
        return $this->hasMany(Groupbuy::class);
    }
}
