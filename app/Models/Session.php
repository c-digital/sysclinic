<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'sessions';

    protected $fillable = [
    	'id_customer',
    	'id_product',
    	'quantity',
    	'realized',
    	'date'
    ];

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function product()
    {
        return $this->belongsTo(ProductService::class, 'id_product');
    }

    public function getStatusAttribute()
    {
    	$count = count(json_decode($this->realized, true));
    	return $count . ' sesiones realizadas de ' . $this->quantity . ' contradas.';
    }

    public function getCountAttribute()
    {
    	$count = count(json_decode($this->realized, true));
    	return $count;
    }

    public function scopeTreatment($query, $treatment)
    {
        if ($treatment) {
            return $query->where('id_product', $treatment);
        }
    }

    public function scopeCustomer($query, $customer)
    {
        if ($customer) {
            return $query->where('id_customer', $customer);
        }
    }

    public function scopeDate($query, $start, $end)
    {
        if ($start && $end) {
            return $query->whereBetween('date', [$start, $end]);
        }

        if ($start) {
            return $query->whereDate('date', '>=', $start);
        }

        if ($end) {
            return $query->whereDate('date', '<=', $end);
        }
    }
}
