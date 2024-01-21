<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use Illuminate\Support\Facades\DB;



class CalculateController extends Controller
{
    public function calc1_show(){
        return view('calculates.calc1');
    }

    public function calc1_show_test(){
        return view('calculates.calc1_test');
    }

    public function calc2_show(){
        return view('calculates.calc2');
    }


public function data_building(Request $request){
    
    // 建築構造を値で取得する（建築構造はvalue数値で$requestに渡されるはず）
    $building_structure = $request->building_structure;
    switch ($building_structure) {
        case "1":
            $columnName = 'src_price';
            break;
        case "2":
            $columnName = 'rc_price';
            break;
        case "3":
            $columnName = 'sc_price';
            break;
        case "4":
            $columnName = 'lgs_price';
            break;
        case "5":
            $columnName = 'wood_price';
            break;
    }

    // 年と構造に基づいてデータベースから標準建設費を取得
    $construction_cost = DB::table('buildings')
    ->where('building_age', $request->built_year)
    ->whereRaw("{$columnName} IS NOT NULL")
    ->first();

    // 標準建築費をJSON形式でレスポンスとして返す
    return response()->json([
        'constructionCost' => $construction_cost,
    ]);
}




}