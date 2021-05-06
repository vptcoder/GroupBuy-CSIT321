<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Status code - User POV - Admin POV:
// g11 - Active - Active
// g12 - Processing - Pending payments
// g13 - Processing - Processing orders
// g21 - Closed - Closed

class Groupbuy extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $fillable = [
			'product_id'
			, 'status' 
			, 'date_start'
			, 'date_end'
			, 'min_required'
			, 'max_available'
			, 'started_by'
			, 'date_success'
    ];

	public function product(){
        return $this->belongsTo(Product::class, 'product_id');
  }

	public function orders(){
			return $this->hasMany(Order::class);
	}
}
