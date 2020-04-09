<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Values extends Model
{
 
    protected $fillable = ['name'];
    
    public function properties(){

        return  $this->belongsTo(Property::class);

    }
}
