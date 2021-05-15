<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    // use HasFactory, Notifiable;
    use SoftDeletes, Notifiable, HasApiTokens, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'shipping_streetaddress',
        'shipping_city',
        'shipping_postalcode',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function watchlists() {
        return $this->hasMany(Watchlist::class);
    }

    public function shoptokens() {
        return $this->hasMany(ShopToken::class);
    }

}
