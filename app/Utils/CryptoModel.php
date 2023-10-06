<?php

namespace App\Utils;

use Illuminate\Support\Facades\Crypt;

class CryptoModel
{

    static public function crypto($text){
        return Crypt::encryptString($text);
    }

    static public function decrypt($text){
        return Crypt::decryptString($text);
    }
}