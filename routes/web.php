<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;

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
    return redirect()->route('blogs');

});

Auth::routes();

Route::prefix('blog')->middleware('auth') ->group(function () {

Route::get('/',[BlogController::class,'report'])->name('blog.report');
Route::get('/create',[BlogController::class,'create'])->name('blog.create');
Route::post('/save',[BlogController::class,'save'])->name('blog.save');
Route::get('/edit/{id}',[BlogController::class,'edit'])->name('blog.edit');
Route::post('/update',[BlogController::class,'update'])->name('blog.update');
Route::get('/delete/{id}',[BlogController::class,'delete'])->name('blog.delete');


    Route::prefix('category')->group(function () {
Route::get('/',[BlogCategoryController::class,'report'])->name('category.report');
Route::get('/create',[BlogCategoryController::class,'create'])->name('category.create');
Route::post('/save',[BlogCategoryController::class,'save'])->name('category.save');
Route::get('/edit/{id}',[BlogCategoryController::class,'edit'])->name('category.edit');
Route::post('/update',[BlogCategoryController::class,'update'])->name('category.update');
Route::get('/delete/{id}',[BlogCategoryController::class,'delete'])->name('category.delete');
    });




});




Route::get('/blogs/{cat?}',[BlogController::class,'getBlogs'])->name('blogs');
Route::get('/blogs/{slug?}/detail',[BlogController::class,'blogDetails'])->name('blog.details');

Route::get('/home',function(){
    return redirect()->route('blogs');
})->name('home');
