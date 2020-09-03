<?php 
namespace App\billing;
use Illuminate\Support\Str;


class paymentGateway {



public function __construct($currency)
{
    $this->currency=$currency;
}    
public function charge($amount){

return[
    'amount'=> $amount,
    'conf_num'=>Str::random(),
    'currency'=>$this->currency,
];


}






}












?>