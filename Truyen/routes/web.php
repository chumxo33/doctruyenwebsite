<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\TheloaiController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\SocialController;
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

Route::get('/', [IndexController::class, 'home' ]);

Route::get('/xem-truyen/{slug}', [IndexController::class, 'xemtruyen' ]);

Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc' ]);
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai' ]);
Route::get('/xem-chapter/{slug}', [IndexController::class, 'xemchapter' ]);
Route::get('/tim-kiem', [IndexController::class, 'timkiem' ]);


// Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax' ]);

Auth::routes();

Route::group(['middleware' => [ 'auth', 'role:admin' ]], function () {
    // Route::resource('/user', UserController::class);
    Route::get('/phan-vaitro/{id}', [UserController::class, 'phanvaitro']);
    Route::get('/phan-quyen/{id}', [UserController::class, 'phanquyen']);
    Route::post('/insert_roles/{id}', [UserController::class, 'insert_roles']);
    Route::post('/insert_permission/{id}', [UserController::class, 'insert_permission']);
    Route::post('/axtra-permission', [UserController::class, 'axtra_permission']);  //Thêm permission
    Route::get('/impersonate/user/{id}', [UserController::class,'impersonate']);

}); 

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/danhmuc', CategoryController::class);
    Route::resource('/theloai', TheloaiController::class);

     Route::resource('/user', UserController::class);
    Route::resource('/truyen', TruyenController::class);
    Route::resource('/chapter', ChapterController::class);
        
    Route::get('/phan-vaitro/{id}', [UserController::class, 'phanvaitro']);
    Route::get('/phan-quyen/{id}', [UserController::class, 'phanquyen']);
    Route::post('/insert_roles/{id}', [UserController::class, 'insert_roles']);
    Route::post('/insert_permission/{id}', [UserController::class, 'insert_permission']);
    Route::post('/axtra-permission', [UserController::class, 'axtra_permission']);  //Thêm permission
    Route::get('/home', [HomeController::class, 'index'])->name('home');
        
    Route::get('/redirect-google', [SocialController::class, 'redirectGoogle'])->name('redirectGoogle');
    Route::get('/google_callback', [SocialController::class, 'processGoogleLogin']);

});


