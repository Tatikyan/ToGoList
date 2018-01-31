<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class toGoList extends Model
{
    protected $fillable = ['placeName', 'latitude', 'longitude', 'visited'];
}
