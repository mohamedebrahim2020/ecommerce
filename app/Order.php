<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['contact_email', 'shipping_address', 'shipping_method'];

    public function users()
    {

        return  $this->belongsTo(User::class);
    }

    public function products()
    {

        return  $this->belongsToMany(Product::class)->withPivot('quantity', 'created_at');
    }
}
