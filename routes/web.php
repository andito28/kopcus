<?php
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\MenusAdminController;
use App\Http\Controllers\admin\EventsAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\menu\MenuController;
use App\Http\Controllers\menu\SubmenuController;
use App\Http\Controllers\menu\SubsubmenuController;
use App\Http\Controllers\menu\SubsubsubmenuController;
use App\Http\Controllers\NexmoSMSController;
use App\Http\Controllers\role\RoleController;
use App\Http\Controllers\cust\DashboardController;
use App\Http\Controllers\cust\MenusController;
use App\Http\Controllers\cust\EventsController;
use App\Http\Controllers\cust\KeranjangController;
use App\Http\Controllers\cust\PesananController;
use App\Http\Controllers\UserController;

// use ADMINISTRATOR

use App\Http\Controllers\user\PasswordController;
use App\Http\Controllers\user\UserVerifyController;

// pegawai
use Illuminate\Support\Facades\Route;

// end use kepala rungan

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

Route::resource('/', AuthController::class);
Route::get('/notauthorized', [UserController::class, 'notauthorized']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerAdd'])->name('register');
Route::middleware(['login'])->group(function () {
    Route::resource('/login', AuthController::class);
});

Route::get('sendSMS', [NexmoSMSController::class, 'index']);

Route::resource('/password', PasswordController::class);
Route::get('/verify/{token}/{email}', [AuthController::class, 'verified']);

//Route event Admin

Route::middleware(['Admin'])->group(function () {

    Route::resource('/menu', MenuController::class);
    Route::resource('/sub_menu', SubmenuController::class);
    Route::resource('/sub_sub_menu', SubsubmenuController::class);
    Route::resource('/sub_sub_sub_menu', SubsubsubmenuController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/role', RoleController::class);
    Route::post('/access', [RoleController::class, 'access'])->name('access');

    Route::resource('/dashboard', DashboardAdminController::class);
    Route::resource('/menu', MenusAdminController::class);
    Route::get('/menu/create', [MenusAdminController::class, 'create']);
    Route::put('/menu', [MenusAdminController::class, 'store']);
    Route::get('/menu/{id}/edit', [MenusAdminController::class, 'edit']);
    Route::put('/menu/{id}', [MenusAdminController::class, 'update']);
    Route::delete('/menu/{id}', [MenusAdminController::class, 'destroy']);
    Route::resource('/event', EventsAdminController::class);
    Route::get('/event/create', [EventsAdminController::class, 'create']);
    Route::post('/event', [EventsAdminController::class, 'store']);
    Route::get('/event/{id}/edit', [EventsAdminController::class, 'edit']);
    Route::put('/event/{id}', [EventsAdminController::class, 'update']);
    Route::delete('/event/{id}', [EventsAdminController::class, 'destroy']);


    Route::resource('/user_verify', UserVerifyController::class);
    Route::get('/user_verify_role/{role_id}/{users_id}', [UserVerifyController::class, 'user_change_role']);


});

Route::middleware(['User'])->group(function () {
    Route::resource('/home', DashboardController::class);
    Route::resource('/events', EventsController::class);
    Route::get('/events/{id}', [EventsController::class, 'show']);
    Route::resource('/menus', MenusController::class);
    Route::resource('/user', UserController::class);

    Route::get('/keranjang',[KeranjangController::class,'index'])->name('keranjang');
    Route::post('/keranjang-store',[KeranjangController::class,'store'])->name('keranjang.store');
    Route::delete('/keranjang-delete/{id}',[KeranjangController::class,'destroy'])->name('keranjang.delete');
    Route::post('/keranjang-update',[KeranjangController::class,'update'])->name('keranjang.update');

    Route::get('/pesanan',[PesananController::class,'index'])->name('pesan');
    Route::get('/pesanan-list',[PesananController::class,'OrderList'])->name('orderList');
    Route::post('/pesanan-store',[PesananController::class,'store'])->name('orderStore');
    Route::get('/pesanan-detail/{id}',[PesananController::class,'detail'])->name('detailOrder');
});
