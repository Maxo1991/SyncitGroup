<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function storeContact(Request $request){
        var_dump($request);die;
//        return response()->json();
    }
}
