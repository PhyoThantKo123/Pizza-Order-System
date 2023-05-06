<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // category list page
    public function list(){
        $lists = Category::orderBy('id','desc')->when(request('key'),function($q){
            $item = request('key');
            $q->where('name','like','%'.$item.'%');
        })->paginate(4);
        return view('admin.category.list',compact('lists'));
    }

    // category create page
    public function createPage(){
        return view('admin.category.create');
    }


    // category create
    public function create(Request $request){
        $this->categoryValidation($request);
        $data = $this->categoryData($request);
        Category::create($data);

        return redirect()->route('category#list')->with(['created' => 'Created  Category Success !']);
    }


    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('category#list')->with(['deleted' => 'Deleted Category Success !']);
    }



    // category data
    public function categoryData($req){
        return [
            'name' => $req->categoryName
        ];
    }




    // category edit page
    public function edit($id){
        // dd($id);
        $data = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }

    // cateogry update
    public function update(Request $req){
        $this->categoryValidation($req);
        // dd($req->categoryId);
        $data = $this->categoryData($req);
        Category::where('id',$req->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updated'=>'updated Category Success']);
    }

     // category validation check
     private function categoryValidation($req){
        Validator::make($req->all(),[
            'categoryName' => 'required|unique:categories,name,'.$req->categoryId
        ])->validate();
    }




}
