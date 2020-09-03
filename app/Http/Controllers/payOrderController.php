<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\billing\paymentGateway;

class payOrderController extends Controller
{
    public function store(paymentGateway $paymentGateway){
       
        // $paymentGateway = new paymentGateway();

        //dd($paymentGateway->charge(250));
        dd(app(paymentGateway::class),app(paymentGateway::class));//diff between singletone and bind
        
    }
}
