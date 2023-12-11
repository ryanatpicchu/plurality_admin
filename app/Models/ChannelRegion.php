<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelRegion extends Model
{
    protected $table = 'channel_regions';

    protected $fillable = ['channel_id', 'region_id'];

    
}