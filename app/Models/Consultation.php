<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    public $timestamps = false;

    protected $table = 'consultations';

    protected $fillable = [
        'id_customer', 
        'id_user',
        'id_company',
        'created_by',
        'date', 
        'fields', 
        'images', 
        'status',
        'id_consultations_types',
        'photo'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function type()
    {
        return $this->belongsTo(ConsultationType::class, 'id_consultations_types');
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            $query->where('status', $status);
        }
    }

    public function scopeInicio($query, $inicio)
    {
        if ($inicio) {
            $query->where('date', '>=', $inicio);
        }
    }

    public function scopeFin($query, $fin)
    {
        if ($fin) {
            $query->where('date', '>=', $fin);
        }
    }

    public function scopePaciente($query, $paciente)
    {
        if ($paciente) {
            $query->whereHas('customer', function ($query) use ($paciente) {
                $query->where('name', 'LIKE', '%' . $paciente . '%');
            });
        }
    }

    public function scopeTipo($query, $tipo)
    {
        if ($tipo) {
            $query->where('id_consultations_types', $tipo);
        }
    }

    public function getPhotoWithRouteAttribute()
    {
        $customer = Customer::find($this->id_customer);

        if ($customer->photo) {
            return '/storage/' . $customer->photo;
        }

        return 'http://sysclinic.net/storage/uploads/avatar/User_font_awesome.svg_1667932474.png';
    }
}
