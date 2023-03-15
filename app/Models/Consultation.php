<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultations';

    protected $fillable = [
        'id_customer', 
        'id_user', 
        'date', 
        'fields', 
        'images', 
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo('Customer', 'id_customer');
    }

    public function user()
    {
        return $this->belongsTo('User', 'id_user');
    }
}
