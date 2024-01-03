<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\sliderController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CheckOutController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// FRONT-END
Route::get('/', [
    HomeController::class, 'index'
])->name('home');

Route::get('/trang-chu', [
    HomeController::class, 'index'
])->name('home');


// BACK-END
Route::get('/admin_login', [
    AdminController::class, 'index'
])->name('admin_login');

Route::get('/dashboard', [
    AdminController::class, 'show_dashboard'
])->name('dashboard');

//XỬ LÝ LOG_OUT
Route::get('/logout', [
    AdminController::class, 'logout'
])->name('logout');

Route::post('/admin-dashboard', [
    AdminController::class, 'dashboard'
])->name('/admin-dashboard');


// XỬ LÝ CATEGORY-PRODUCT (DASHBOARD)

Route::get('/add-category-product', [
    CategoryProductController::class, 'add_category_product'
])->name('add-category-product');

Route::get('/all-category-product', [
    CategoryProductController::class, 'all_category_product'
])->name('all-category-product');

// Xử lý Hiden/Show của trang all_category_product
Route::get('/unactive-category-product/{category_product_id}', [
    CategoryProductController::class, 'unactive_category_product'
])->name('unactive-category-product');

Route::get('/active-category-product/{category_product_id}', [
    CategoryProductController::class, 'active_category_product'
])->name('active-category-product');

// End

// Xử lý trang UPDATE CATEGORY
Route::get('/edit-category-product/{category_product_id}', [
    CategoryProductController::class, 'edit_category_product'
])->name('edit-category-product');

Route::post('/update-category-product/{category_product_id}', [
    CategoryProductController::class, 'update_category_product'
])->name('update-category-product');

Route::get('/delete-category-product/{category_product_id}', [
    CategoryProductController::class, 'delete_category_product'
])->name('delete-category-product');


Route::post('/save-category-product', [
    CategoryProductController::class, 'save_category_product'
])->name('save-category-product');

Route::get('/search-category-product', [
    CategoryProductController::class, 'search_category_product'
])->name('search-category-product');

// END
// END :  XỬ LÝ CATEGORY-PRODUCT (DASHBOARD)

// ============================================================================================================

// XỬ LÝ PRODUCT (DASHBOARD)

Route::get('/add-product', [
    ProductController::class, 'add_product'
])->name('add-product');

Route::get('/all-product', [
    ProductController::class, 'all_product'
])->name('all-product');

// Xử lý Hiden/Show của trang product
Route::get('/unactive-product/{product_id}', [
    ProductController::class, 'unactive_product'
])->name('unactive-product');

Route::get('/active-product/{product_id}', [
    ProductController::class, 'active_product'
])->name('active-product');


// Xử lý trang UPDATE Product
Route::get('/edit-product/{product_id}', [
    ProductController::class, 'edit_product'
])->name('edit-product');

Route::post('/update-product/{product_id}', [
    ProductController::class, 'update_product'
])->name('update-product');

Route::get('/delete-product/{product_id}', [
    ProductController::class, 'delete_product'
])->name('delete-product');


Route::post('/save-product', [
    ProductController::class, 'save_product'
])->name('save-product');

Route::get('/search-product', [
    ProductController::class, 'search_product'
])->name('search-product');

//============================================================================================================

// XỬ LÝ Member (DASHBOARD)

Route::post('/register-member', [
    MemberController::class, 'store'
])->name('register-member');

Route::get('register-member', [
    MemberController::class, 'create'
])->name('register-member');

Route::get('/all-member', [
    MemberController::class, 'all_member'
])->name('all-member');


// Xử lý trang UPDATE member
Route::post('/ban-member/{id}', [
    MemberController::class, 'banMember'
])->name('ban-member');

Route::post('/unban-member/{id}', [
    MemberController::class, 'unbanMember'
])->name('unban-member');

Route::get('/search', [
    MemberController::class, 'search'
])->name('search');

// Route::post('/save-product', [
//     MemberController::class, 'save_product'
// ])->name('save-product');

//============================================================================================================


// Xử lý Banner

Route::get('manage-slider', [
    sliderController::class, 'manage_slider'
])->name('manage-slider');

Route::get('add-slider', [
    sliderController::class, 'add_slider'
])->name('add-slider');

Route::post('insert-slider', [
    sliderController::class, 'insert_slider'
])->name('insert-slider');

// Xử lý Hiden/Show của trang slider
Route::get('/unactive-slide/{id}', [
    sliderController::class, 'unactive_slide'
])->name('unactive-slide');

Route::get('/active-slide/{id}', [
    sliderController::class, 'active_slide'
])->name('active-slide');

Route::get('/delete-slide/{id}', [
    sliderController::class, 'delete_slide'
])->name('delete-slide');

Route::get('/search-slider', [
    sliderController::class, 'search_slider'
])->name('search-slider');

//============================================================================================================
//Quản lý Order
// add tocard
Route::get(
    '/product/add-to-card/{id}',
    [
        CartsController::class, 'addToCard'
    ]
)->name('addToCard');
//cart detail
Route::get('/cartDetail', [
    CartsController::class, 'showCart'
])->name('cartDetail');
//update cart
Route::get('/cart-update', [
    CartsController::class, 'upDateCart'
])->name('updateCart');
Route::get('/cart-delete_by_id', [
    CartsController::class, 'deleteCartById'
])->name('deleteCart');

// route check out
Route::get('/check_out', [

    CartsController::class, 'getTotal'
])->name('check_out');
Route::post('/vn_payment', [

    CheckOutController::class, 'vn_payment'
])->name('vn_payment');
Route::post('/vn_momo', [

    CheckOutController::class, 'vn_momo'
])->name('vn_momo');
Route::post('/vn_onepay', [

    CheckOutController::class, 'vn_onepay'
])->name('vn_onepay');
//route thank History
Route::get('/thank', [

    HistoryController::class, 'index'
])->name('thank');

Route::get('/thank_vn_momo', [

    HistoryController::class, 'insertPaymentVnMomo'
])->name('isert_momo');
Route::get('/thank_vn_pay', [

    HistoryController::class, 'insertPaymentVNpay'
])->name('isert_vn_pay');

Route::get('/data_user', [

    HistoryController::class, 'getDataCheckOut'
])->name('input_data');
