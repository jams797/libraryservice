<?php

namespace App\Http\Bll;

use App\Http\Models\ResponseGeneralModel;
use App\Models\ParamBook;
use App\Models\TransacUser;
use App\Utils\CryptoModel;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class BookBll
{
    public function Consult($name, $categoryId, $locationId){
        $bookFindTmp = DB::table('param_book')
                    ->join('param_category', 'param_book.categoryId', '=', 'param_category.id')
                    ->join('config_location_book', 'param_book.id', '=', 'config_location_book.bookId')
                    ->join('param_location', 'config_location_book.locationId', '=', 'param_location.id');

        if($name != null) {
            $bookFindTmp = $bookFindTmp->where('param_book.book', 'LIKE', '%' . $name . '%');
        }
        if($categoryId != null) {
            $bookFindTmp = $bookFindTmp->where('param_category.id', '=', $categoryId);
        }
        if($locationId != null) {
            $bookFindTmp = $bookFindTmp->where('param_location.id', '=', $locationId);
        }
        $bookFind = $bookFindTmp
                    ->orderBy('param_location.id', 'asc')
                    ->orderBy('param_book.book', 'asc')
                    ->get();

        $arrayRet = [];
        $locationIdAnt = 0;
        $countArr = -1;
        foreach ($bookFind as $key => $value) {
            if($value->locationId != $locationIdAnt){
                $arrayRet[] = [
                    'locationId'    => $value->locationId,
                    'location'      => $value->location,
                    'books'         => [],
                ];
                $locationIdAnt = $value->locationId;
                $countArr ++;
            }
            $arrayRet[$countArr]['books'][] = [
                'book'          => $value->book,
                'price'         => $value->price,
                'categoryId'    => $value->categoryId,
                'locationId'    => $value->locationId,
            ];
        }

        return response()->json(new ResponseGeneralModel(
            $arrayRet,
            '',
            ''
        ), 401);
    }
}
