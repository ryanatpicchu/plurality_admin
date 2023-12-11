<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelGroup extends Model
{
    protected $table = 'channel_groups';

    protected $fillable = ['order', 'channel_id', 'display_in_menu', 'name', 'type', 'created_by'];

    public function relatedRegion()
    {
        return $this->belongsToMany(Region::class, 'channel_group_regions', 'channel_group_id' ,'region_id'); 
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function adSlotGroups()
    {
        return $this->hasMany(AdslotGroup::class, 'channel_group_id');
    }
    
}