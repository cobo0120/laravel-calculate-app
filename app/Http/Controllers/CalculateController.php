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
  dd($request);
    // 建築構造を値で取得する（建築構造はvalue数値で$requestに渡される）
   $building_structure = $request->input('building_structure');
   switch ($building_structure) {
       case 1:
           $columnName = 'src_price';
           break;
       case 2:
           $columnName = 'rc_price';
           break;
       case 3:
           $columnName = 'sc_price';
           break;
       case 4:
           $columnName = 'lgs_price';
           break;
       case 5:
           $columnName = 'wood_price';
           break;
   }

    // 年と構造に基づいてデータベースから建設費を取得
   $cost = DB::table('buildings')
       ->where('building_age')
       ->where($columnName, '<>', '') // 空でない値を選択
       ->first()
       ->$columnName; // ダイナミックなカラム名を使用

   // 標準建築費をJSON形式でレスポンスとして返す
   return response()->json
   ([
    'constructionCost' => $cost,
    ]);
    }
}



// public function data_destination(Request $request)
// {
 
//     // データを取得（1〜5件取ってくる）各ページごとに最初の行をスキップしてデータを取得するように設定
//     $users = User::offset(($request->page-1)*3)->limit(3)->get();
//     foreach($users as $user){
//         $user['department'] = $user->department()->get();
//     }
//     $allUsers=User::all();
    
//     // データ数を取得
//     // $dataCount = count($allUsers);
//     // ページ番号の最大値を取得
//     $pageMax = ceil(count($allUsers) / 3);
//     // // ページ番号を生成するための配列を作成
//     // $pageNumbers = [];
//     // // ページ番号を生成する
//     // for ($i = 1; $i <= $pageMax; $i++) {
//     // $pageNumbers[] = $i;
//     //   }

//     // 部署名を表示させるには多次元連想配列を使う？
//     return response()->json([
//         'users' => $users,  
//         'pageMax' => $pageMax,]);
    
// }