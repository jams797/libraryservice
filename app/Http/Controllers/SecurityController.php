<?php

namespace App\Http\Controllers;

use App\Http\Bll\SecurityBll;
use App\Http\Models\ResponseGeneralModel;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Throwable;

class SecurityController extends Controller
{
    public function Login(Request $request){
        try{
            $responseModel = new ResponseGeneralModel();
            $dataReq = $request->all();
            $validatedData = $request->validate([
                'user' => 'required|min:4|max:25',
                'pass' => 'required|min:8|max:25',
            ]);
            $bll = new SecurityBll();
            $resp = $bll->Login($dataReq['user'], $dataReq['pass']);
            return $resp;
        }
        catch (Throwable $ex){
            return response()->json(new ResponseGeneralModel(
                null,
                'Ocurrio un error',
                $ex->getMessage()
            ), 500);
        }
    }
}
