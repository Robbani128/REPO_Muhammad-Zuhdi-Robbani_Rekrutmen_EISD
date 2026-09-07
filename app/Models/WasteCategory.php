<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteCategory extends Model
{
    protected $fillable = [
        'name',
        'point_per_kg',
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_wastes')->withPivot('weight_kg')->withTimestamps();
    }
}
