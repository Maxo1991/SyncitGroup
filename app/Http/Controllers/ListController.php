<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function index(){
        $contacts = DB::table('contacts')->get();
        $numbers = DB::table('numbers')->get();
        return view('list', compact(['contacts', 'numbers']));
    }
    public function deleteContact(Request $request){
        $contact = new Contact;
        $contact = Contact::find($request->id);
        $contact->delete($request->id);
        foreach($request->listNumber as $number){
            $delete = new Number;
            $delete = Number::find($number);
            $delete->delete($number);
        }
        return response()->json(['success' => true],200);
    }
    public function deleteNumber(Request $request){
        $number = new Number;
        $number = Number::find($request->id);
        $number->delete($request->id);
        return response()->json(['success' => true],200);
    }
    public function insertNumber(Request $request){
        DB::table('numbers')->insert(
            array(
                'contact_id'     =>   $request->id,
                'type'   =>   $request->type,
                'number' =>   $request->number
            )
        );
        return response()->json(['success' => true],200);
    }
    public function updateNumber(Request $request){
        DB::table('numbers')
            ->where('id', $request->id)
            ->update(array('type' => $request->type, 'number' => $request->number));
        return response()->json(['success' => true],200);
    }
}
