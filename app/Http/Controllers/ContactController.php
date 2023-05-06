<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function list(){
        $contacts = Contact::paginate(4);
        return view('admin.contact.list',compact('contacts'));
    }

    public function delete(Request $req){
        logger($req->id);
        Contact::where('id',$req->id)->delete();
        $response = [
            'message' => 'Delete to cart complete',
            'status' => 'success'
        ];

        return response()->json($response,200);
    }
}
