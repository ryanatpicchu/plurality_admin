<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreviewImage extends Model
{
    protected $table = 'preview_images';

    protected $fillable = ['order','channel_id','name','thumbnail','full','type', 'file_id','note'];

    
}