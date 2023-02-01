<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\CustomerController;



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
//     return view('pages.dashboard');
// });

// Route::get('/login',function(){
//     return view('auth.login');
// });

Route::get('/',[AdminController::class,'loginPage'])->name('app.login');
Route::post('/admin/login',[AdminController::class,'Login'])->name('admin.login');
Route::get('/admin/logout',[AdminController::class,'Logout'])->name('admin.logout');


Route::prefix('admin')->middleware('admin')->group(function(){

    // =================controller auth and login=======
    Route::controller(AdminController::class)->group(function(){
        Route::get('/dashboard','Dashboard')->name('app.dashboard');
        Route::get('/cache-clear', 'cacheClear')->name('admin.cache.clear');

     });

    //----------------user management -----------
    Route::controller(Usercontroller::class)->group(function(){
        Route::get('/users','index')->name('admin.user');
        Route::post('/users/store','adminCreate')->name('admin.user.store');
        Route::post('/user/update','adminUpdate')->name('admin.update');
        Route::get('/user/delete/{id}','adminDelete')->name('admin.delete');
    });

    Route::controller(VillageController::class)->group(function(){
        Route::get('/customer/village','index')->name('customer.village.index');
        Route::post('/customer/village/store','Store')->name('customer.village.store');
        Route::post('/customer/village/edit','Edit')->name('customer.village.edit');
        Route::get('/customer/village/delete/{id}','Delete')->name('customer.village.delete');
        // ---for laid---
        Route::get('/customer/village/lead','LeadIndex')->name('customer.village.laid');
        Route::post('/customer/village/laid/store','LaidStore')->name('customer.village.laidstore');
        Route::post('/customer/village/laid/update','LaidUpdate')->name('customer.village.laidupdate');
        Route::get('/customer/village/laid/delete/{id}','LaidDelete')->name('customer.village.laiddelete');

    });

    Route::controller(CustomerController::class)->group(function(){
        Route::get('/customer/index', 'Index')->name('customer.index');
        Route::post('/customer/store', 'CustomarStore')->name('customer.store');
        Route::post('/customer/edit', 'CustomarEdit')->name('customer.update');
        Route::get('/customer/delete/{id}', 'CustomarDelete')->name('customer.delete');
        Route::get('/customer/halkhata/view', 'HalkhataView')->name('customer.HalkhataView');
        Route::post('/customer/halkhata/store', 'HalkhataStore')->name('customer.HalkhataStore');
        Route::get('/customer/halkhata/edit/{id}', 'HalkhataEdit')->name('customer.HalkhataEdit');
        Route::post('/customer/halkhata/update', 'HalkhataUpdate')->name('customer.HalkhataUpdate');
        Route::get('/customer/halkhata/cancle/{id}', 'HalkhataCancle')->name('customer.HalkhataCancle');
        Route::get('/generate/pdf','GenaratePdf')->name('pdf.Report');

    });

});


Route::get('/blank',function(){
    return view('pages.blank');
});



require __DIR__.'/auth.php';
