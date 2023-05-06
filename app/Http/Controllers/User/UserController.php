<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // home page
    public function home(){
        $pizzas = Product::orderBy('id','desc')->get();
        $category = Category::orderBy('id','desc')->get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('pizzas','category','carts','orders'));
    }

    // change password page

    public function changePasswordPage(){
        return view('user.account.changePassword');
    }


    // change password
    public function changepassword(Request $request){
        $this->passwordValid($request);

        $getid = Auth::user()->id;
        $user = User::where('id',$getid)->select('password')->first();
        $getcurps = $user->password;

        $oldpassword = $request->oldPassword;

        if(Hash::check($oldpassword,$getcurps)){
            $newps = Hash::make($request->newPassword);
            $data = ['password' => $newps];
            User::where('id',$getid)->update($data);
            return back()->with(['feedback' => 'Password Changed !']);
        }else{
            return back()->with(['notMatch' => 'old password does not match !']);
        }
    }



    // account page
    public function profile(){
        return view('user.account.profile');
    }

    // update account
    public function updateprofile(Request $request,$id){
        $this->updateValid($request,$id);
        $data = $this->updatedata($request);


        $getimg = Auth::user()->image;

        if($request->hasFile('image')){

            if($getimg != null){
                Storage::delete('./public/'.$getimg);
            }

            $img_name = uniqid() . '_user_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$img_name);

            $data['image'] = $img_name;

        }


        User::where('id',$id)->update($data);
        return back()->with(['updated' => 'profile update is success !']);

    }




    // details page
    public function details(){
        $pizza = Product::when(request('pizza'),function($query){
            $id = request('pizza');
            $query->where('id',$id);
        })->first();
        $lists = Product::get();
        return view('user.main.details',compact('pizza','lists'));
    }



    // cart list page
    public function cartlist(){
        $lists = Cart::select('carts.*','products.name as pizza','products.price as pizza_price','products.image as pizza_img')
        ->where('carts.user_id',Auth::user()->id)
        ->join('products','products.id','carts.product_id')->get();

        $sum = 0;

        foreach($lists as $list){
            $sum += $list->pizza_price * $list->qty;
        }

        return view('user.main.cart',compact('lists','sum'));
    }

    // cart delete page
    public function cartdelete(){
        Cart::where('user_id',Auth::user()->id)->delete();
        return redirect()->route('user#homePage');
    }


    // contact page
    public function contact(){
        return view('user.main.contact');
    }

    // contact add to db
    public function contactAdd(Request $request){
        $this->contactValid($request);
        $data = $this->contactData($request);

        Contact::create($data);

        return redirect()->route('user#contact')->with(['feedback' => 'We get your message. Thank You for support us']);
    }


    public function history(){
        $lists = Order::orderBy('created_at','desc')->where('user_id',Auth::user()->id)->paginate(4);
        return view('user.main.history',compact('lists'));
    }





    // update account validate
    private function updateValid($req,$id){
        Validator::make($req->all(),[
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file'
        ])->validate();
    }


    private function contactValid($req){
        Validator::make($req->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ])->validate();
    }


    // update request data
    private function updatedata($req){
        return [
            'name' => $req->name,
            'email' => $req->email,
            'gender' => $req->gender,
            'phone' => $req->phone,
            'address' => $req->address
        ];
    }

     // update request data
     private function contactData($req){
        return [
            'name' => $req->name,
            'email' => $req->email,
            'message' => $req->message
        ];
    }



    // change password validate
    private function passwordValid($req){
        Validator::make($req->all(),[
            'oldPassword' => 'required|min:6|max:15',
            'newPassword' => 'required|min:6|max:15',
            'confirmPassword' => 'required|min:6|max:15|same:newPassword'
        ])->validate();
    }

}
