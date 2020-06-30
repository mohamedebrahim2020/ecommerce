<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable  implements BannableContract
{
    use Bannable;
    use Notifiable;
    use HasRoles;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products(){

        return  $this->belongsToMany('App\Product', 'rates', 'user_id', 'product_id');

    }
     
    public function orders(){
        return $this->hasMany(Order::class);
    }
    
    public function favourites(){
        return $this->belongsToMany('App\Product', 'favourites', 'user_id', 'product_id');
    }

    public function reviews(){
        return $this->belongsToMany('App\Product', 'reviews', 'user_id', 'product_id');
    }

    // for admins

    

}
