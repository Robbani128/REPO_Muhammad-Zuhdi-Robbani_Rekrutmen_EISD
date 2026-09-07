<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'customer_id',
        'merchant_id',
        'status',
        'total_points',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function wastes()
    {
        return $this->belongsToMany(WasteCategory::class, 'transaction_wastes')->withPivot('weight_kg')->withTimestamps();
    }
}
