<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// login , register



Route::middleware('admin_auth')->group(function(){
    Route::redirect('/', 'loginPage');

    Route::get('/loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});


Route::middleware(['auth'])->group(function () {


    // check login | register auth

    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // start admin section


    Route::middleware(['admin_auth'])->group(function(){

        // category
        Route::prefix('category')->group(function(){
            Route::get('/list',[CategoryController::class,'list'])->name('category#list');
            Route::get('/createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('/create',[CategoryController::class,'create'])->name('category#create');
            Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('/edit/update',[CategoryController::class,'update'])->name('category#update');
        });

        Route::prefix('admins')->group(function(){
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password/change',[AdminController::class,'changePassword'])->name('admin#changePassword');
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('details/edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('details/edit/update/{id}',[AdminController::class,'update'])->name('admin#update');
            Route::get('/list',[AdminController::class,'list'])->name('admin#list');
            Route::get('/delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
        });


        Route::prefix('products')->group(function(){
            Route::get('/list',[ProductController::class,'list'])->name('products#list');
            Route::get('/createPage',[ProductController::class,'createPage'])->name('products#createPage');
            Route::post('createPage/create',[ProductController::class,'create'])->name('products#create');
            Route::get('/delete/{id}',[ProductController::class,'delete'])->name('products#delete');
            Route::get('details/{id}',[ProductController::class,'details'])->name('products#details');
            Route::get('details/edit/{id}',[ProductController::class,'edit'])->name('products#edit');
            Route::post('/update',[ProductController::class,'update_pizza'])->name('products#update');
        });


        Route::prefix('orders')->group(function(){
            Route::get('/list',[OrderController::class,'list'])->name('orders#list');
            Route::get('status/filter',[OrderController::class,'osfilter'])->name('order#statusFilter');
            Route::get('listInto/{id}',[OrderController::class,'listinto'])->name('order#listInto');
        });

        Route::prefix('ajax')->group(function(){
            // Route::get('order/status/filter',[OrderController::class,'osfilter'])->name('order#statusFilter');
            Route::get('order/status/change',[OrderController::class,'oschange'])->name('order#statusChange');
            Route::get('role/change',[AdminController::class,'change'])->name('changeRole');
            Route::get('contact/delete',[ContactController::class,'delete'])->name('contact#delete');
        });


        Route::prefix('users')->group(function(){
            Route::get('list',[UsersController::class,'userlist'])->name('users#list');
            Route::get('delete/{id}',[UsersController::class,'userdelete'])->name('user#delete');
            Route::get('edit/{id}',[UsersController::class,'useredit'])->name('user#edit');
            Route::post('update/{id}',[UsersController::class,'userupdate'])->name('user#update');
        });


        Route::prefix('contact')->group(function(){
            Route::get('list',[ContactController::class,'list'])->name('contact#list');
        });


    });


    // end admin section



    // start user section

    Route::group(['prefix' => 'user','middleware' => 'user_auth'],function(){
        // Route::get('/home',function(){
        //     return view('user.home');
        // })->name('user#homePage');

        Route::get('/home',[UserController::class,'home'])->name('user#homePage');


        Route::get('/contact',[UserController::class,'contact'])->name('user#contact');
        Route::post('/contact/add',[UserController::class,'contactAdd'])->name('contact#add');

        Route::prefix('/pizza')->group(function(){
            Route::get('/details',[UserController::class,'details'])->name('user#detailPage');
        });

        Route::prefix('account')->group(function(){
            Route::get('/profile',[UserController::class,'profile'])->name('user#profilePage');
            Route::post('/profile/{id}',[UserController::class,'updateprofile'])->name('user#updateProfile');
        });

        Route::prefix('password')->group(function(){
            Route::get('/changePasswordPage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('/change',[UserController::class,'changepassword'])->name('user#changePassword');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('filter',[AjaxController::class,'filter'])->name('ajax#filter');
            Route::get('cart/add',[AjaxController::class,'addtocart'])->name('ajax#cartAdd');
            Route::get('cart/update',[AjaxController::class,'updatecart'])->name('ajax#cartUpdate');
            Route::get('cart/delete',[AjaxController::class,'deletecart'])->name('ajax#cartDelete');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('product/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#viewCount');
        });


        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartlist'])->name('user#cartList');
            Route::get('delete',[UserController::class,'cartdelete'])->name('user#cartDelete');
        });

        Route::prefix('orders')->group(function(){
            Route::get('/history',[UserController::class,'history'])->name('orders#history');
        });


    });
    // end user section

});

// admin



Route::get('webTesting',function(){
    $data = [
        'message' => 'this is web testing message'
    ];

    return response()->json($data,200);
});



