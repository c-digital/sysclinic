<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
	public $timestamps = false;

	protected $table = 'recipes';

    protected $fillable = [
        'id_customer', 
        'id_user',
        'date', 
        'description'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
