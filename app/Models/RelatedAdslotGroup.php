<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedAdslotGroup extends Model
{
    protected $table = 'related_adslot_groups';

    protected $fillable = ['region_id', 'adslot_group_id', 'related_adslot_groups', 'type'];

}