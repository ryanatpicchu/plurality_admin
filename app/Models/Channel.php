<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table = 'channels';

    protected $fillable = ['order', 'name', 'display_in_menu'];

    public function relatedRegion()
    {
        return $this->belongsToMany(Region::class, 'channel_regions', 'channel_id' ,'region_id')
        ->orderBy('regions.order','asc'); 
    }

    public function relatedPerformanceAd()
    {
        return $this->hasMany(PerformanceAd::class)
        ->orderBy('performance_ads.id','asc'); 
    }

    public function channelGroups()
    {
        return $this->hasMany(ChannelGroup::class, 'channel_id');
    }

}