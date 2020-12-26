<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function storeContact(Request $request){
        $data = DB::table('contacts')->insert(
            array(
                'firstname'     =>   $request->contacts[0][0],
                'lastname'   =>   $request->contacts[0][1]
            )
        );
        $lastId = DB::getPdo()->lastInsertId();
        for($i = 0; $i < $request->contacts[0][4]; $i++){
            DB::table('numbers')->insert(
                array(
                    'contact_id'    =>   $lastId,
                    'type'     =>   $request->contacts[0][2][$i],
                    'number'   =>   $request->contacts[0][3][$i]
                )
            );
        }
        return response()->json(['success' => true, 'request' => $request],200);
    }
}
