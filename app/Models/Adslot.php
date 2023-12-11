<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adslot extends Model
{
    protected $table = 'adslots';

    protected $fillable = [
        'order', 
        'days', 
        'list_price', 
        'impressions',
        'repetitions', 
        'display_repetitions', 
        'pricing_method', 
        'display_type', 
        'profit_share_type', 
        'start_date', 
        'end_date', 
        'sale_status', 
        'adslot_group_id', 
        'preview_image_id', 
        'spec', 
        'note',
        'created_by',
    ];

    public function relatedRegion()
    {
        return $this->belongsToMany(Region::class, 'adslot_regions', 'adslot_id' ,'region_id'); 
    }

    public function adslotGroup()
    {
        return $this->belongsTo(AdslotGroup::class, 'adslot_group_id');
    }


}