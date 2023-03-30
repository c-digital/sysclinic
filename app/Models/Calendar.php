<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public $timestamps = false;
    
    protected $table = 'calendar';

    protected $fillable = ['title', 'productsServices', 'id_user', 'id_customer', 'id_company', 'date', 'status'];

    public function scopeUsuario($query, $id_user)
    {
        if ($id_user) {
            return $query->where('id_user', $id_user);
        }
    }

    public function scopePatient($query, $patient)
    {
        if ($patient) {
            return $query->whereHas('customer', function ($query) use ($patient) {
                return $query->where('name', 'LIKE', '%' . $patient . '%');
            });
        }
    }

    public function scopeDoctor($query, $doctor)
    {
        if ($doctor) {
            return $query->whereHas('user', function ($query) use ($doctor) {
                return $query->where('name', 'LIKE', '%' . $doctor . '%');
            });
        }
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
    }

    public function scopeStart($query, $start)
    {
        if ($start) {
            return $query->whereDate('date', '>=', $start);
        }
    }

    public function scopeEnd($query, $end)
    {
        if ($end) {
            return $query->whereDate('date', '<=', $end);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
