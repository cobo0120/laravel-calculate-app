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
    $construction_cost = 
    Building::select($columnName)->where('building_age', $request->built_year)
        ->whereNotNull($columnName)
        ->first();

    // 標準建築費が見つからない場合、建物の年齢に基づいて最新または最古の費用を取得
    if (is_null($construction_cost)) {
        if ($request->building_age <= 3) {
            // 最新の標準建築費を取得
            $construction_cost = Building::select($columnName)
                ->whereNotNull($columnName)
                ->orderBy('building_age', 'desc')
                ->first();
        } else {
            // 最古の標準建築費を取得
            $construction_cost = Building::select($columnName)
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


}



// 標準建築費をJSON形式でレスポンスとして返す
//    switch ($construction_cost->construction_cost) {
//     case 1:
//         return response()->json([
//             'construction_cost' => $construction_cost->src_price,
//         ]);
//     case 2:
//         return response()->json([
//             'construction_cost' => $construction_cost->sc_price,
//         ]);
//     case 3:
//         return response()->json([
//             'construction_cost' => $construction_cost->rc_price,
//         ]);
//     case 4:
//         return response()->json([
//             'construction_cost' => $construction_cost->lgs_price,
//         ]);
//     case 5:
//         return response()->json([
//             'construction_cost' => $construction_cost->wood_price,
//         ]);
//     default:
//         return response()->json([
//             'construction_cost' => $construction_cost,
//         ]);
// }



// 解説
// $construction_cost が null の場合、データベースに一致するレコードが存在しないことを意味します。
// この場合、関数は建物の年齢が3年以下かどうかをチェックします。3年以下であれば、建物の年齢を降順に並べ替えて最初のレコードを取得し、
// 最新の建設費を取得します。建物の年齢が3年を超える場合、建物の年齢を昇順に並べ替えて最初のレコードを取得し、最古の建設費を取得します

// 標準建設費が見つからない場合、建物の年齢に基づいて最新または最古の費用を取得
    // if (!$construction_cost) {
    //     if ($request->building_age <= 3) {
    //         // 最新の標準建築費を取得
    //         $construction_cost = Building::whereNotNull($columnName)
    //             ->orderBy('building_age', 'desc')
    //             ->first();
    //     } else {
    //         // 最古の標準建築費を取得
    //         $construction_cost = Building::whereNotNull($columnName)
    //             ->orderBy('building_age', 'asc')
    //             ->first();
    //     }
    // }