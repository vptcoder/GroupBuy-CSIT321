<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
	// use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'user_id',
		'title',
		'message',
		'link',
		'status'
	];
	
	protected $attributes = [
		'status' => 'n01'
	];
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
