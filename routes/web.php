<?php

use App\Http\Controllers\Cartcontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategoryCotroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Mail\OrderMail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

// Route::get('/', function () {
//     return view('template');
// });
// Route::get('/abc', function () {
//     return view('abc');
// });

Route::get('/home', function () {
    return view('enduser.home');
})->name('my-home');


Route::get('/about', function () {
    return view('enduser.about');
})->name('my-about')->middleware('auth');


Route::get('/contact', function () {
    return view('enduser.contact');
})->name('my-contact')->middleware('auth');


// Route::get('/blog', function () {
//     return view('enduser.blog');
// })->name('my-blog');

Route::get('/blog', [PostController::class, 'getAllPost'])->name('my-blog');


Route::get('/policy', function () {
    return view('enduser.policy');
})->name('my-policy');

Route::get('/products', function () {
    return view('enduser.products');
})->name('my-products');

Route::get('/category', [CategoryController::class, 'getAllCategories'])->name('my-categories');



//hai cách nói chuyện với db
//cách 1: query builder
//cách 2:eloquent
Route::get('/login/index', [LoginController::class, 'getLogin'])->name('login.index');
Route::post('/login/index', [LoginController::class, 'postLogin'])->name('login.login');
Route::post('/login/logout', [LoginController::class, 'postLogout'])->name('login.logout');




// phần routes admin
Route::prefix('admin')->group(function () {
    Route::get('', function () {
        return view('admin.layout1');
    });
    Route::get('post', function () {
        return view('admin.post.list');
    });
    Route::get('user', [UserController::class, 'getUser']);

    //product
    Route::post('product/get_slug', [ProductController::class, 'getSlug'])->name('product.get_slug');

    Route::get('product', [ProductController::class, 'getProduct'])->name('product.list');

    Route::get('product/add', [ProductController::class, 'getViewProductAdd'])
        ->name('product.add');

    Route::post('product/save', [ProductController::class, 'addProduct'])->name('product.save');

    Route::post('product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');



    Route::get('product/edit/{id}', [ProductController::class, 'getDetail'])->name('product.edit');
    Route::post('product/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');

    //product_categories
    Route::get('product_category', [ProductCategoryCotroller::class, 'getProductCategory'])->name('product_category.list');
    Route::get('product_category/add', function () {
        return view('admin.product_category.add');
    })->name('product_category.add');
    Route::post('product_category/save', [ProductCategoryCotroller::class, 'addProductCategory'])->name('product_category.save');
    Route::post('product_category/delete/{id}', [ProductCategoryCotroller::class, 'deleteProductCategory'])->name('product_category.delete');
    Route::post('product_category/get_slug', [ProductCategoryCotroller::class, 'getSlug'])->name('product_category.get_slug');

    //blogs
    Route::get('post', [PostController::class, 'getPost'])->name('post.list');

    Route::get('post/add', [PostController::class, 'getViewPostAdd'])->name('post.add');

    Route::post('post/save', [PostController::class, 'addPost'])->name('post.save');

    Route::post('post/delete/{id}', [PostController::class, 'deletePost'])->name('post.delete');

    Route::get('post/edit/{id}', [PostController::class, 'getPostDetail'])->name('post.edit');

    Route::post('post/edit/{id}', [PostController::class, 'editPost'])->name('post.edit');
    //orders 10/12
    Route::get('order', [CheckoutController::class, 'getOrder'])->name('order.list');
});


Route::get('/', [HomeController::class, 'getProduct'])->name('home');
Route::get('shop', [ProductController::class, 'getProductToShop'])->name('shop');
Route::get('product/{slug}', [ProductController::class, 'getProductBySlug'])->name('product.detail.slug');

//cart
Route::get('add-to-cart/{id}/{qty?}', [Cartcontroller::class, 'addProductToCart'])->name('add.product.to.cart');
Route::get('shopping-cart', [Cartcontroller::class, 'shoppingCart'])->name('shopping.cart');
Route::get('delete-cart', [Cartcontroller::class, 'deleteCart'])->name('delete.cart');
Route::get('deleteItemCart/{id}', [Cartcontroller::class, 'deleteItemCart'])->name('delete.item.cart');
Route::post('update-cart', [Cartcontroller::class, 'updateCart'])->name('update.cart');

//checkout
Route::get('checkout', [Cartcontroller::class, 'checkoutCart'])->name('checkout.cart')->middleware('auth');
Route::post('place-order', [CheckoutController::class, 'saveOrder'])->name('place.order');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('send-mail', function () {
//     $data = [
//         'name' => 'Thai',
//         'age' => 30
//     ];
//     Mail::to("happyboyhn92@gmail.com")->send(new OrderMail($data));
// });
