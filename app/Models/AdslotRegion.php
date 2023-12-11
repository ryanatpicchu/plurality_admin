<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdslotRegion extends Model
{
    protected $table = 'adslot_regions';

    protected $fillable = ['adslot_id', 'region_id'];

}