<?php

namespace App\Http\Controllers;

use App\Http\Bll\BookBll;
use App\Http\Models\ResponseGeneralModel;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Throwable;

class BookController extends Controller
{
    public function Consult(Request $request){
        try{
            $responseModel = new ResponseGeneralModel();
            $dataReq = $request->all();
            $validatedData = $request->validate([
                'name' => 'min:4|max:25',
                'categoryId' => 'integer',
                'locationId' => 'integer',
            ]);
            $bll = new BookBll();
            $resp = $bll->Consult(
                $dataReq['name']        ?? null,
                $dataReq['categoryId']  ?? null,
                $dataReq['locationId']  ?? null,
            );
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
