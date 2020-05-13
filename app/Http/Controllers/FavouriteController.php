<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
   public function myfavourites (User $user){
      
    $favourites = $user->favourites;
    
    return view('myfavourites',['favourites'=>$favourites]);
    return redirect()->to('/myfavourites');
   }
}
