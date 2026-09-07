<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionWaste extends Model
{
    protected $fillable = [
        'transaction_id',
        'waste_category_id',
        'weight_kg',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function wasteCategory()
    {
        return $this->belongsTo(WasteCategory::class);
    }
}
