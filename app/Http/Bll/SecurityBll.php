<?php

namespace App\Http\Bll;

use App\Http\Models\ResponseGeneralModel;
use App\Models\TransacUser;
use App\Utils\CryptoModel;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class SecurityBll
{
    public function Login($user, $pass){
        $userFind = TransacUser::where('user', $user)
                ->first();
        
        if($userFind != null) {
            if(CryptoModel::decrypt($userFind->pass) == $pass) {
                $customClaims = [
                    'iss' => 'issuer',
                    'iat' => now()->timestamp,
                    'exp' => now()->addSeconds(ENV('JWT_TIME_SEC'))->timestamp,
                    'nbf' => now()->timestamp,
                    'sub' => 'subject_id',
                    'jti' => md5(uniqid(rand(), true)),
                    'userId' => $userFind->id,
                ];
                $payload = JWTFactory::customClaims($customClaims)->make();
                return response()->json(new ResponseGeneralModel(
                    [
                        'jwt' => JWTAuth::encode($payload)->get()
                    ],
                    '',
                    ''
                ), 200);
            }
        }

        return response()->json(new ResponseGeneralModel(
            null,
            'Usuario y/o contraseña incorrecta',
            ''
        ), 401);
    }
}
