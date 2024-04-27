<?php
namespace App\lib;
use App\Models\LogDetails;
use Auth;

class LogHelper{

  function Createlog($log_message){

    LogDetails::create([
        'log_details' => $log_message,
        'user_id' =>Auth::id(),
        'ip_address' => \Request::ip(),
      ]);
    return;
  }

}
