<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;



class CalculateController extends Controller
{
    public function calc1_show(){
        return view('calculates.calc1');
    }

    public function calc2_show(){
        return view('calculates.calc2');
    }
}