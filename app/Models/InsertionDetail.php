<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsertionDetail extends Model
{
    protected $table = 'insertion_details';

    protected $fillable = [
        'insertion_id', 
        'combination_key', 
        'channel_id', 
        'region_id',
        'channel_group_id',
        'adslot_group_id',
        'ad_id',
        'days', 
        'sales_unit', 
        'total_list_price', 
        'discount_percentage', 
        'total_sale_price', 
        'note', 
        'at_which_row',
        'date_ranges',
        'status'
    ];

    public function dateRanges()
    {
        return $this->hasOne(InsertionDetailDateRange::class);
    }

    
    public function insertion()
    {
        return $this->belongsTo(Insertion::class, 'insertion_id');
    }

    public function channel()
    {
        return $this->hasOne(Channel::class,'id','channel_id');
    }

    public function region()
    {
        return $this->hasOne(Region::class,'id', 'region_id');
    }

    public function channelGroup()
    {
        return $this->hasOne(ChannelGroup::class,'id', 'channel_group_id');
    }

    public function adslotGroup()
    {
        return $this->hasOne(AdslotGroup::class,'id', 'adslot_group_id');
    }
    
}