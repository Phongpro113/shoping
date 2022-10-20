<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\AdminSettingController;
use Symfony\Component\Routing\Route as RoutingRoute;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'checkLogin'])->name('checkLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->middleware('can:list-category')->name('categories.index');
    Route::prefix('categories')->group(function(){
//        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    });

    Route::prefix('/menus')->group(function(){
        Route::get('/', [MenuController::class, 'index'])->name('menus.index');
        Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
        Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menus.edit');
        Route::post('/update/{id}', [MenuController::class, 'update'])->name('menus.update');
        Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('menus.delete');
    });

    // Product
    Route::prefix('product')->group(function(){
        Route::get('/', [AdminProductController::class, 'index'])->name('product.index');
        Route::get('/create', [AdminProductController::class, 'create'])->name('product.create');
        Route::post('/store', [AdminProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [AdminProductController::class, 'update'])->name('product.update');
        Route::get('/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete');
    });
    Route::prefix('slider')->group(function(){
        Route::get('/', [AdminSliderController::class, 'index'])->name('slider.index');
        Route::get('/create', [AdminSliderController::class, 'create'])->name('slider.create');
        Route::post('/store', [AdminSliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}', [AdminSliderController::class, 'edit'])->name('slider.edit');
        Route::post('/update/{id}', [AdminSliderController::class, 'update'])->name('slider.update');
        Route::get('/delete/{id}', [AdminSliderController::class, 'delete'])->name('slider.delete');
    });
    Route::prefix('setting')->group(function(){
        Route::get('/', [AdminSettingController::class, 'index'])->name('setting.index');
        Route::get('/create', [AdminSettingController::class, 'create'])->name('setting.create');
        Route::post('/create', [AdminSettingController::class, 'store'])->name('setting.store');
        Route::get('/edit/{id}', [AdminSettingController::class, 'edit'])->name('setting.edit');
        Route::post('/update/{id}', [AdminSettingController::class, 'update'])->name('setting.update');
        Route::get('/delete/{id}', [AdminSettingController::class, 'delete'])->name('setting.delete');
    });
    Route::prefix('user')->group(function(){
        Route::get('/', [AdminUserController::class, 'index'])->name('user.index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('user.create');
        Route::post('/create', [AdminUserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('user.delete');
    });
    Route::prefix('roles')->group(function(){
        Route::get('/', [AdminRoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [AdminRoleController::class, 'create'])->name('roles.create');
        Route::post('/create', [AdminRoleController::class, 'store'])->name('roles.store');
        Route::get('/edit/{id}', [AdminRoleController::class, 'edit'])->name('roles.edit');
        Route::post('/update/{id}', [AdminRoleController::class, 'update'])->name('roles.update');
        Route::get('/delete/{id}', [AdminRoleController::class, 'delete'])->name('roles.delete');
    });
    Route::prefix('permissions')->group(function () {
        Route::get('create', [AdminRoleController::class, 'createPermission'])->name('permissions.create');
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});




