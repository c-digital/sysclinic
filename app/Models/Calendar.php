<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public $timestamps = false;
    
    protected $table = 'calendar';

    protected $fillable = ['title', 'productsServices', 'id_user', 'id_customer', 'id_company', 'date'];

    public function scopeUser($query, $id_user)
    {
        if ($id_user) {
            return $query->where('id_user', $id_user);
        }
    }
}
