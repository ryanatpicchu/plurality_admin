<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsertionDetailDateRange extends Model
{
    protected $table = 'insertion_detail_date_ranges';

    protected $fillable = [
        'insertion_detail_id', 
        'combination_key', 
        'date_ranges'
    ];

    public function insertion_detail()
    {
        return $this->belongsTo(InsertionDetail::class, 'insertion_detail_id');
    }
    
}