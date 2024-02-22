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
        case "2":
            $columnName = 'src_price';
            break;
        case "3":
            $columnName = 'rc_price';
            break;
        case "4":
            $columnName = 'sc_price';
            break;
        case "5":
            $columnName = 'lgs_price';
            break;
        case "6":
            $columnName = 'wood_price';
            break;
        case "7":
            $columnName = 'wood_price';
            break;
    }

    // 年と構造に基づいてデータベースから標準建設費を取得
    $construction_cost = 
    Building::select($columnName . ' as price')->where('building_age', $request->built_year)
        ->whereNotNull($columnName)
        ->first();

    // データベース上に標準建築費が見つからない場合、建物の年齢に基づいて最新または最古の費用を取得
    if (is_null($construction_cost)) {
        if ($request->building_age <= 10) {
            // 最新の標準建築費を取得
    $construction_cost = Building::select($columnName .' as price')
                ->whereNotNull($columnName)
                ->orderBy('building_age', 'desc')
                ->first();
        } else {
            // 最古の標準建築費を取得
            $construction_cost = Building::select($columnName.' as price')
                ->whereNotNull($columnName)
                ->orderBy('building_age', 'asc')
                ->first();
        }
    }

    // 標準建築費をJSON形式でレスポンスとして返す
    return response()->json([
        'construction_cost' => $construction_cost,
    ]);
}





public function calc2_result(Request $request){

        $request->validate([
        'loan_period' => 'required|integer|min:1|max:35',
        'interest_rate' => 'required|numeric|min:0|max:10',
   
    ]);

        return redirect('errorPage');
}



}



