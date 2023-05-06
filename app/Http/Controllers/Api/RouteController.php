<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //
    public function list(){
        $products = Product::get();
        $users = User::get();
        $categories = Category::get();
        $orders = Order::get();
        $orderList = OrderList::get();
        $contact = Contact::get();

        $data = [
            'product' => [
                'list' => $products
            ],
            'user' => [
                'list' => $users
            ],
            'category' => [
                'list' => $categories
            ],
            'order' => [
                'orders' => $orders,
                'order_list' => $orderList
            ],
            'contact' => [
                'list' => $contact
            ]
        ];

        return response()->json($data,200);
    }


    public function product(){
        $products = Product::get();
        return response()->json($products,200);
    }


    // category create
    public function cc(Request $req){
        // dd($req->header('headerData'));
        $data = [
            'name' => $req->name
        ];

        $response = Category::create($data);

        return response()->json($response,200);
    }



    // contact create
    public function cc1(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        $response = Contact::create($data);

        return response()->json($response,200);

    }



    //  category delete (post)
    // public function cd(Request $request){
    //     $data = Category::where('id',$request->id)->first();

    //     if(isset($data)){
    //         Category::where('id',$request->id)->delete();
    //         return response()->json(['status' => true,'message' => 'delete success']);
    //     }

    //     return response()->json(['status' => false,'message' => 'delete not success']);

    // }



    // category delete (get)
    public function cd($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status' => true,'message' => 'delete success']);
        }

        return response()->json(['status' => false,'message' => 'delete not success']);

    }



    public function c_details($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            return response()->json($data,200);
        }

        return response()->json(['status' => false,'message' => 'there is no category'],500);
    }



    public function c_update(Request $request){
        $id = $request->id;

        $check = Category::where('id',$id)->first();

        if(isset($check) and $request->name){

            $data = [
                'name' => $request->name
            ];

            Category::where('id',$id)->update($data);
            $response = Category::where('id',$id)->first();

            return response()->json($response,200);

        }

        return response()->json(['status' => false,'message' => 'there is no category for update'],500);

    }






}
