<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

session_start();

class ProductController extends Controller
{
    // Hàm check login
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id == true) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin_login')->send();
        }
    }


    public function add_product()
    {
        $this->AuthLogin();

        $cate_product = DB::table('category_product')->orderby('category_id', 'desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product);
    }

    public function all_product()
    {
        $this->AuthLogin();

        $all_product = DB::table('product')
            ->join('category_product', 'category_product.category_id', '=', 'product.category_id')
            ->orderBy('product.product_id', 'desc')->paginate(10);

        $manage_product = view('admin.all_product')->with('all_product', $all_product);  // Hiển thị dữ liệu lên trang 'all_product'
        return view('admin_layout')->with('admin.all_product', $manage_product);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();

        // Lấy CSDL
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;
        //1. user có ảnh
        $get_image = $request->file('product_image');

        //2. nếu chọn ảnh, up lên từ đâu đó
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();             // Lấy tên ảnh
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();    // Lấy đuôi mở rộng (jpeg , jpg,..)
            $get_image->move('public/uploads/product', $new_image);   // đường  dẫn tới nơi lưu ảnh
            $data['product_image'] = $new_image;
            DB::table('product')->insert($data);
            Session::put('message', 'Add product successfully');
            return Redirect::to('add-product');
        } else {
            $data['product_image'] = '';
        }


        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        DB::table('product')->insert($data);
        Session::put('message', 'Add product successfully');
        return Redirect::to('add-product');
    }

    // Hàm xử lý Show/Hiden
    public function unactive_product($product_id)
    {
        $this->AuthLogin();

        DB::table('product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message1', 'Deactivated product successfully');
        Log::info('Redirecting to all-product after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();

        DB::table('product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Activated product successfully');
        Log::info('Redirecting to all-product after activation.'); // Thêm log kiểm tra lỗi
        return Redirect::to('all-product');
    }

    // Hàm xử lý Edit product
    public function edit_product($product_id)
    {
        $this->AuthLogin();

        $cate_product = DB::table('category_product')->orderby('category_id', 'desc')->get();

        $edit_product = DB::table('product')->where('product_id', $product_id)->get();

        $manage_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product);
        return view('admin_layout')->with('admin.edit_product', $manage_product);
    }

    // Hàm xử lý Update product , Sử dụng phương thức Request vì cần lấy yêu cầu dữ liệu
    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();             // Lấy tên ảnh
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();    // Lấy đuôi mở rộng (jpeg , jpg,..)
            $get_image->move('public/uploads/product', $new_image);   // đường  dẫn tới nơi lưu ảnh
            $data['product_image'] = $new_image;
            DB::table('product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Update product successfully');
            return Redirect::to('all-product');
        }

        DB::table('product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Update product successfully');
        return Redirect::to('all-product');
    }

    // Hàm xử lý Delete product ,
    public function delete_product($product_id)
    {
        $this->AuthLogin();

        DB::table('product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Delete category successfully');
        return Redirect::to('all-product');
    }

    public function search_product(Request $request)
    {
        // Lấy danh sach sản phẩm
        $all_product = Product::where('product_name', 'like', '%' . $request->search_product . '%')->orWhere('product_price', $request->search_product)->paginate(10);

        // Trả về view hiển thị sau khi lọc
        return view('admin.all_product', ['all_product' => $all_product->isEmpty() ? null : $all_product]);
    }
}
