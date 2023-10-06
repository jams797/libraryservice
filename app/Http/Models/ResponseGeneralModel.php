<?php

namespace App\Http\Models;

use Illuminate\Http\Request;

class ResponseGeneralModel
{
    public $data;
    public string $message;
    public string $messageDev;

    public function __construct($data = null, $message = null, $messageDev = null)
    {
        if($data != null || $message != null){
            $this->data = $data;
            $this->message = $message;
            $this->messageDev = $messageDev;
        }
    }

    public function getMessageDev(){
        if(ENV('APP_DEBUG') == true) return $this->messageDev;
        else return "";
    }
}
