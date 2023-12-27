<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;

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

// End

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

// END
// END :  XỬ LÝ -PRODUCT (DASHBOARD)


// XỬ LÝ CUSTOMER (DASHBOARD)
// Route member registration
Route::post('/register-member', [
    MemberController::class, 'store'
])->name('register-member');

Route::get('register-member', [
    MemberController::class, 'create'
])->name('register-member');

Route::get('/all-member', [
    MemberController::class, 'all_member'
])->name('all-member');
// End


// Xử lý trang UPDATE member
Route::post('/ban-member/{id}', [
    MemberController::class, 'banMember'
])->name('ban-member');

Route::post('/unban-member/{id}', [
    MemberController::class, 'unbanMember'
])->name('unban-member');

// Route::get('/delete-member/{id}', [
//     MemberController::class, 'delete_member'
// ])->name('delete-member');


// Route::post('/save-product', [
//     MemberController::class, 'save_product'
// ])->name('save-product');

// END
// END :  XỬ LÝ -CUSTOMER (DASHBOARD)
