<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdslotGroup extends Model
{
    protected $table = 'adslot_groups';

    protected $fillable = ['order', 'channel_group_id', 'name', 'code', 'created_by'];

    public function channelGroup()
    {
        return $this->belongsTo(ChannelGroup::class, 'channel_group_id');
    }

    public function adslots()
    {
        return $this->hasMany(Adslot::class, 'adslot_group_id');
    }

    public function availableAdslotByRegion($region_id)
    {
        return $this->hasMany(Adslot::class, 'adslot_group_id')
        ->where('sale_status', 1)
        ->with('relatedRegion')->whereHas('relatedRegion', function ($query) use($region_id){
            $query->where('adslot_regions.region_id', $region_id);
        })->first();
    }

    public function availableAdslot()
    {
        return $this->hasMany(Adslot::class, 'adslot_group_id')->where('sale_status', 1);
    }

}