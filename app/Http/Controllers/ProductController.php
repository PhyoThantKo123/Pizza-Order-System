<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // list page
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
        ->orderBy('products.id','desc')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftjoin('categories','products.category_id','categories.id')
        ->paginate(4);


        $pizzas->appends(request()->all());

        return view('admin.products.pizza',compact('pizzas'));
    }


    // create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.products.create',compact('categories'));
    }


    // pizza create
    public function create(Request $request){
        $this->pizzaValid($request,'create');

        $data = $this->pizzaData($request);

        $data['image'] = $this->img_insert($request);


        Product::create($data);

        return redirect()->route('products#list')->with(['created' => 'Pizza has been created']);
    }


    // pizza delete
    public function delete($id){

        $this->img_delete($id);
        Product::where('id',$id)->delete();
        return redirect()->route('products#list')->with(['deleted' => 'One of the pizza has been deleted !']);
    }


    // details page (or) view pge
    public function details($id){
        $pizza = Product::select('products.*','categories.name as category_name')
        ->join('categories','products.category_id','categories.id')
        ->where('products.id',$id)
        ->first();
        return view('admin.products.details',compact('pizza'));
    }


    // edit page
    public function edit($id){
        $pizza = Product::where('id',$id)->first();
        $categories = Category::select('id','name')->get();
        return view('admin.products.edit',compact('pizza','categories'));
    }


    // pizza update
    public function update_pizza(Request $request){
        $this->pizzaValid($request,'update');

        $data = $this->pizzaData($request);

        $id = $request->productId;

        if($request->hasFile('image')){
            $this->img_delete($id);
            $data['image'] = $this->img_insert($request);
        }


        Product::where('id',$id)->update($data);
        return redirect()->route('products#list')->with(['updated' => 'One of the pizza has been updated!']);

    }


    // image delete from storage
    private function img_delete($id){
        $img = Product::select('image')->where('id',$id)->first();
        Storage::delete('./public/'.$img->image);
    }


    // image insert to storage
    private function img_insert($req){
        $imgName = uniqid() . '_pizza_' . $req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public',$imgName);
        return $imgName;
    }


    // validation
    private function pizzaValid($req,$status){

        $items = [
            'productName' => 'required|unique:products,name,'.$req->productId,
            'description' => 'required',
            'price' => 'required',
            'categoryId' => 'required',
            'waitingTime' => 'required'
        ];

        if($status === 'create'){
            $items['image'] = 'required|mimes:png,jpg,jpeg|file';
        }

        Validator::make($req->all(),$items)->validate();
    }

    private function pizzaData($req){
        return [
            'name' => $req->productName,
            'description' => $req->description,
            'price' => $req->price,
            'category_id' => $req->categoryId,
            'waiting_time' => $req->waitingTime
        ];
    }

}
