<?php

use App\Models\billModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    $products_most_view = \App\Models\productModel::all()->sortBy('view')->take(8);
    return view('guest.welcome', ['products_most_view'=>$products_most_view]);
})->name('home');

Route::prefix('/san-pham/{slug}')->group(function () {
    Route::get('/', 'App\Http\Controllers\categoryController@getViewGuest');
});

Route::get('/thong-tin-chi-tiet-san-pham/{id_product}', 'App\Http\Controllers\productController@getViewProductDetail');
Route::get('/comment-product/', 'App\Http\Controllers\productController@getComment');


Route::get('/tim-kiem', 'App\Http\Controllers\productController@getBoxSearch');
Route::get('/tim-kiem/san-pham/{slug}', 'App\Http\Controllers\productController@getBoxProduct');

//Đăng ký
Route::post('/check-email', 'App\Http\Controllers\userController@checkEmail');
Route::put('/dang-ky-tai-khoan', 'App\Http\Controllers\userController@regis');

//Đăng nhập
Route::post('/guest-login', 'App\Http\Controllers\loginController@login');

//Đăng xuất
Route::get('/guest-logout', function () {
    Auth::logout();
    return back();
})->name('logout');

Route::group(['middleware' => 'checkLogin'], function () {

//    Xác thực tài khoản
    Route::post('/send-email-verify', 'App\Http\Controllers\userController@sendVerifyEmail');
    Route::get('/receive-email-verify/{user_id}/{token}', 'App\Http\Controllers\userController@receiveVerifyEmail');

//    Thông tin cá nhân
    Route::post('/cap-nhat-tai-khoan', 'App\Http\Controllers\profileController@updateGuest');

//    Yêu thích
    Route::get('/so-luong-yeu-thich', 'App\Http\Controllers\favouriteController@getCount');
    Route::put('/them-vao-yeu-thich', 'App\Http\Controllers\favouriteController@addFavourite');
    Route::get('/danh-sach-yeu-thich', 'App\Http\Controllers\favouriteController@getList');
    Route::get('/xoa-khoi-danh-sach-yeu-thich', 'App\Http\Controllers\favouriteController@deleteFavourite');

//    Đổi mật khẩu
    Route::post('/thay-doi-mat-khau', 'App\Http\Controllers\userController@changePass');

//    Mua hàng
    Route::post('/thanh-toan-don-hang', 'App\Http\Controllers\billController@addBill');

//    Giao diện hóa đơn
    Route::get('/hoa-don-thanh-toan','App\Http\Controllers\billController@getView');
    Route::get('/xuat-hoa-don/{bill_id}','App\Http\Controllers\billController@getViewPDF');

//    Giao diện mua nhiều
    Route::get('/don-hang','App\Http\Controllers\orderController@getView');

//    Nhắn tin
    Route::post('/gui-tin-nhan','App\Http\Controllers\messageController@sentMess');


    Route::get('/get-list-tin-nhan','App\Http\Controllers\messageController@getList');


//    Bình luận
    Route::post('/gui-binh-luan','App\Http\Controllers\commentController@sentComment');

//    Lịch sử mua hàng
    Route::get('/lich-su-mua-hang','App\Http\Controllers\billController@getDataTable');
    Route::get('/lich-su-mua-hang/xem-chi-tiet/{id}','App\Http\Controllers\billController@getViewBill');
});


Route::get('/test', function () {
//    Auth::attempt(['email'=>'elonmusk@gmail.com','password'=>'123456']);

    return view('guest.responseEmail.verified');
});

Route::get('/admin-logout', function () {
    Auth::logout();
    return redirect('/admin-login');
})->name('admin-logout');

Route::group(['middleware' => 'checkLogout'], function () {
    Route::get('/admin-login', 'App\Http\Controllers\loginController@getView');
    Route::post('/admin-login', 'App\Http\Controllers\loginController@loginAdmin');
});


Route::group(['middleware' => 'checkLogin'], function () {

    Route::group(['middleware' => 'checkRole'], function () {

        Route::get('/admin', function () {
            $qty_brand = \App\Models\brandModel::all()->count();
            return view('admin.welcome', ['qty_brand'=>$qty_brand]);
        })->name('home-admin');

        Route::prefix('admin/tin-nhan')->group(function () {
            Route::get('/', 'App\Http\Controllers\messageController@getView');

            Route::get('/get-list', 'App\Http\Controllers\messageController@getListAdmin');
            Route::get('/get-list-user', 'App\Http\Controllers\messageController@getListUser');

            Route::post('/sent-mess-admin', 'App\Http\Controllers\messageController@sentMessAdmin');

        });

        Route::get('/get-count-mess','App\Http\Controllers\messageController@getCountMess');
        Route::get('/get-count-order','App\Http\Controllers\billController@getCountBill');


        Route::prefix('admin/thuong-hieu')->group(function () {
            Route::get('/', 'App\Http\Controllers\brandController@getView');
            Route::put('/add', 'App\Http\Controllers\brandController@addBrand');
            Route::post('/update', 'App\Http\Controllers\brandController@updateBrand');
            Route::delete('/delete', 'App\Http\Controllers\brandController@deleteBrand');


            Route::get('/datatable', 'App\Http\Controllers\brandController@getDataTable');
        });

        Route::group(['middleware' => 'checkAdmin'], function () {

            Route::prefix('admin/nguoi-dung')->group(function () {
                Route::get('/', 'App\Http\Controllers\userController@getView');
                Route::put('/add', 'App\Http\Controllers\userController@addUser');
                Route::post('/update', 'App\Http\Controllers\userController@updateUser');
                Route::delete('/delete', 'App\Http\Controllers\userController@deleteUser');

                Route::post('/change-password', 'App\Http\Controllers\userController@changePassword');
                Route::post('/check-email-update', 'App\Http\Controllers\userController@checkEmail_update');
                Route::get('/datatable', 'App\Http\Controllers\userController@getDataTable');
            });

            Route::prefix('admin/thong-tin-ca-nhan')->group(function () {
                Route::get('/{id_user}', 'App\Http\Controllers\profileController@getView');
                Route::post('/update/{id_user}', 'App\Http\Controllers\profileController@update');
            });
        });

        Route::prefix('admin/san-pham/')->group(function () {
            Route::get('/', 'App\Http\Controllers\productController@getView');
            Route::get('/danh-muc/{slug}', 'App\Http\Controllers\productController@getSlug');

            Route::get('/them', 'App\Http\Controllers\productController@getViewAdd');
            Route::post('/them', 'App\Http\Controllers\productController@addProduct');

            Route::get('/capnhat/{id_product}', 'App\Http\Controllers\productController@getViewUpdate');
            Route::post('/capnhat', 'App\Http\Controllers\productController@updateProduct');

            Route::delete('/delete', 'App\Http\Controllers\productController@deleteProduct');

            Route::get('/thong-tin-chi-tiet/{id_product}', 'App\Http\Controllers\productController@getInfo');

            Route::get('/datatable', 'App\Http\Controllers\productController@getDataTable');
        });

        Route::prefix('admin/danh-muc/')->group(function () {
            Route::get('/{slug}', 'App\Http\Controllers\categoryController@getView');
        });

        Route::prefix('admin/don-hang/')->group(function () {
            Route::get('/', 'App\Http\Controllers\billController@getViewAdmin');
            Route::get('/chi-tiet-don-hang/{id}', 'App\Http\Controllers\billController@getBillAdmin');
            Route::post('/cap-nhat-don-hang', 'App\Http\Controllers\billController@updateBill');

            Route::get('/get-data-table', 'App\Http\Controllers\billController@getDataTableAdmin');
            Route::get('/get-data-table-for-user/{id_user}', 'App\Http\Controllers\billController@getDataTableAdminForUser');

            Route::get('/xuat-hoa-don/{bill_id}','App\Http\Controllers\billController@getViewPDFAdmin');
        });
    });
});

// Quên mật khẩu
Route::post('/send-code-reset-password', 'App\Http\Controllers\userController@sendCodeResetPass');
Route::post('/receive-code-reset-password', 'App\Http\Controllers\userController@resetPass');
