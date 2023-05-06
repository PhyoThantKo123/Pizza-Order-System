<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // filter home page
    public function filter(Request $request){

        $sql = DB::table('products');

        if($request->status and $request->filter){
            $sql = $request->status === 'desc' ? $sql->orderBy('created_at','desc') : $sql->orderBy('created_at','asc');
            $sql = $sql->whereIn('category_id',$request->filter);
        }elseif($request->status){
            $sql = $request->status === 'desc' ? $sql->orderBy('created_at','desc') : $sql->orderBy('created_at','asc');
        }elseif($request->filter){
            $sql = $sql->whereIn('category_id',$request->filter);
        };

        $data = $sql->get();

        return response()->json($data);
    }


    // add to cart (details page)
    public function addtocart(Request $request){
        $data = $this->getcartdata($request);
        Cart::create($data);
        $response = [
            'message' => 'Add to cart complete',
            'status' => 'success'
        ];

        return response()->json($response,200);
    }


    // update cart (cart page)
    public function updatecart(Request $request){

        Cart::where('id',$request->idx)->update(['qty' => $request->qty]);

        $response = [
            'message' => 'Update to cart complete',
            'status' => 'success'
        ];

        return response()->json($response,200);
    }

    // delete cart (cart page)
    public function deletecart(Request $request){

        Cart::where('id',$request->idx)->delete();

        $response = [
            'message' => 'Delete to cart complete',
            'status' => 'success'
        ];

        return response()->json($response,200);
    }


    // order (cart page)
    public function order(Request $request){
        $total = $request->total;
        $ordercode = 0;

        foreach($request->orders as $order){
            global $ordercode;

            OrderList::create($order);

            $ordercode =  $order['order_code'];
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $ordercode,
            'total_price' => $total
        ]);

        $response = [
            'message' => 'Add to order list complete',
            'status' => 'success'
        ];

        return response()->json($response,200);
    }




    // increase view count
    public function increaseViewCount(Request $request){
        $getcount = Product::where('id',$request->id)->first();
        $count = $getcount->view_count + 1;
        Product::where('id',$request->id)->update(['view_count' => $count]);

        $response = [
            'message' => 'Add to order list complete',
            'status' => 'success'
        ];

        return response()->json($response,200);
    }



    private function getcartdata($req){
        return [
            'user_id' => $req->userid,
            'product_id' => $req->pizzaid,
            'qty' => $req->qty
        ];
    }

}
