<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceAd extends Model
{
    protected $table = 'performance_ads';

    protected $fillable = [
        'order', 
        'name', 
        'start_date', 
        'end_date', 
        'sales_unit', 
        'list_price', 
        'display_list_price', 
        'list_price_not_be_confirmed', 
        'note',
        'sale_status', 
        'channel_id', 
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }


}