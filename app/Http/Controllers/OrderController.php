<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function list(){
        $orders = Order::select('orders.*','users.name as username')
        ->leftJoin('users','users.id','orders.user_id')
        ->get();

        return view('admin.order.orders',compact('orders'));
    }


    // order status filter
    public function osfilter(Request $request){

        $orders = Order::select('orders.*','users.name as username')
        ->leftJoin('users','users.id','orders.user_id');

        $filterstatus = $request->statusfilter == '' ? null : $request->statusfilter;

        if($filterstatus == null){
            $orders = $orders->get();
        }else{
            $orders = $orders->where('orders.status',$filterstatus)->get();
        }

        return view('admin.order.orders',compact('orders'));
    }


    // order status change (ajax)
    public function oschange(Request $request){
        Order::where('order_code',$request->order_code)->update(['status' => $request->status]);

        $response = [
            'message' => 'Delete to cart complete',
            'status' => 'success'
        ];

        return response()->json($response,200);
    }


    public function listinto($id){
        $order = Order::where('order_code',$id)->first();


        $orderlists = OrderList::select('order_lists.*','products.image as product_img','users.name as username','products.name as product_name')
        ->where('order_lists.order_code',$id)
        ->leftjoin('products','products.id','order_lists.product_id')
        ->leftjoin('users','users.id','order_lists.user_id')
        ->get();

        return view('admin.order.orderlist',compact('orderlists','order'));
    }

}
