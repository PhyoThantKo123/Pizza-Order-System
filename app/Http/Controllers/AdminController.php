<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // admin list
    public function list(){
        $admins = User::when(request('key'),function($q){
            $q->orwhere('name','like','%'.request('key').'%')
              ->orwhere('email','like','%'.request('key').'%')
              ->orwhere('phone','like','%'.request('key').'%')
              ->orwhere('address','like','%'.request('key').'%')
              ->orwhere('gender','like','%'.request('key').'%');
        })
        ->where('role','admin')
        ->paginate(3);
        return view('admin.account.list',compact('admins'));
    }

    // delete
    public function delete($id){
        $user = User::where('id',$id)->first();
        $getimg = $user->image;

        if($getimg != null){
            Storage::delete('./public/'.$getimg);
        }

        User::where('id',$id)->delete();
        return back()->with(['deleted' => 'Admin Account has been deleted !']);
    }


    // change password page
    public function changePasswordPage(){
        return view('admin.account.changepassword');
    }

    // change password
    public function changePassword(Request $request){
        $this->passwordValid($request);

        $curUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$curUserId)->first()->toArray();
        $curUserPs = $user['password'];
        $password = $request->oldPassword;
        $newps = $request->newPassword;

        if(Hash::check($password, $curUserPs)){
            $data = ['password' => Hash::make($newps)];
            User::where('id',$curUserId)->update($data);

            // Auth::logout();
            return back()->with(['feedback' => 'Password Changed !']);
        }else{
            return back()->with(['notMatch' => 'Old Password is wrong!']);
        };

    }


    // details page
    public function details(){
        return view('admin.account.details');
    }

    // edit page
    public function edit(){
        return view('admin.account.edit');
    }


    // update
    public function update($id,Request $request){
        $this->updateUserValid($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            // $getcurrentuser = User::where('id',$id)->first();
            // $getimg = $getcurrentuser->image;
            $getimg = Auth::user()->image;

            if($getimg != null){
                Storage::delete('./public/'.$getimg);
            }

            $img_name = uniqid() . '_admin_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$img_name);
            $data['image'] = $img_name;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updated' => 'Update is Success !']);
    }




    // change role
    public function change(Request $request){

        User::where('id',$request->id)->update(['role' => $request->role]);

        $response = [
            'message' => 'Delete to cart complete',
            'status' => 'success'
        ];

        return response()->json($response,200);
    }


    private function passwordValid($req){
        Validator::make($req->all(),[
            'oldPassword' => 'required|min:6|max:15',
            'newPassword' => 'required|min:6|max:15',
            'confirmPassword' => 'required|min:6|max:15|same:newPassword',
        ])->validate();
    }

    private function getUserData($req){
        return [
            'name' => $req->name,
            'email' => $req->email,
            'gender' => $req->gender,
            'phone' => $req->phone,
            'address' => $req->address
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
