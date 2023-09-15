<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoticeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
}); 

Auth::routes();

Route::middleware('auth')->group(function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});



Route::resource('course',CourseController::class);
Route::get('/enroll/{course}',[CourseController::class,'enroll'])->name('enroll');
Route::put('/enroll/attach/{user}',[CourseController::class,'attach'])->name('course.attach');
Route::delete('/enroll/detach/{user}',[CourseController::class,'detach'])->name('course.detach');


Route::get('/courses/{course}/notice',[NoticeController::class,'index'])->name('course.notices');
Route::post('/courses/{course}/notice/create',[NoticeController::class,'store'])->name('notice.store');
Route::delete('/course/notices/{notice}/delete',[NoticeController::class,'destroy'])->name('notice.delete');