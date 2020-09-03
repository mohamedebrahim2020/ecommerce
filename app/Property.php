<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['property'];

    public function products()
    {

        return  $this->belongsTo(Product::class);
    }

    public function values()
    {
        return $this->hasMany(Values::class);
    }
}
