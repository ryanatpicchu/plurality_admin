<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelGroupRegion extends Model
{
    protected $table = 'channel_group_regions';

    protected $fillable = ['channel_group_id', 'region_id'];

    
}