<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';

    protected $fillable = ['title', 'productsServices', 'id_user', 'id_customer', 'id_company', 'date'];
}
