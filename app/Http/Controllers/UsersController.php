<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    // user list page
    public function userlist(){
        $users = User::where('role','user')->paginate(4);
        return view('admin.user.list',compact('users'));
    }

    // user delete
    public function userdelete($id){

        $user = User::where('id',$id)->first();
        $getimg = $user->image;

        if($getimg != null){
            Storage::delete('./public/'.$getimg);
        }

        User::where('id',$id)->delete();
        Cart::where('user_id',$id)->delete();
        Order::where('user_id',$id)->delete();
        OrderList::where('user_id',$id)->delete();

        return back()->with(['deleted' => 'User Account had been deleted !']);
    }


    // user edit page
    public function useredit($id){
        $user = User::where('id',$id)->first();
        return view('admin.user.edit',compact('user'));
    }

    public function userupdate(Request $request,$id){
        $this->updateUserValid($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $getcurrentuser = User::where('id',$id)->first();
            $getimg = $getcurrentuser->image;

            if($getimg != null){
                Storage::delete('./public/'.$getimg);
            }

            $img_name = uniqid() . '_admin_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$img_name);
            $data['image'] = $img_name;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('users#list')->with(['updated' => 'User update had been deleted !']);
    }




    private function getUserData($req){
        return [
            'name' => $req->name,
            'email' => $req->email,
            'gender' => $req->gender,
            'phone' => $req->phone,
            'address' => $req->address,
            'role' => $req->role
        ];
    }


    private function updateUserValid($req){
        Validator::make($req->all(),[
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$req->id,
            'gender' => 'required',
            'phone' => 'required|min:4',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file'
        ])->validate();
    }

}



