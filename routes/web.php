<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticeController;
use App\Models\Comment;
use App\Models\User;
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



Route::middleware('roleAuthenticate')->group(function(){
    Route::resource('course',CourseController::class);
Route::get('/enroll/{course}',[CourseController::class,'enroll'])->name('enroll');
Route::put('/enroll/attach/{user}',[CourseController::class,'attach'])->name('course.attach');
Route::delete('/enroll/detach/{user}',[CourseController::class,'detach'])->name('course.detach');
Route::get('/courses/{course}/notice',[NoticeController::class,'index'])->name('course.notices');
Route::post('/courses/{course}/notice/create',[NoticeController::class,'store'])->name('notice.store');
Route::delete('/course/notices/{notice}/delete',[NoticeController::class,'destroy'])->name('notice.delete');
});



Route::get('/course/{course}/comments',[CommentController::class,'index'])->name('comments');
Route::post('/course/comments',[CommentController::class,'store'])->name('comment.store');
Route::delete('/course/{comment}/delete/comment',[CommentController::class,'destroy'])->name('comment.delete');


Route::get('/course/{course}/enrolled/student',[HomeController::class,'student_list'])->name('student.list');




Route::get('/hello',function(){
    $user = auth()->user();
    $user->load('enroll');
    return  $user;
    return  $user->courses;
 // $user = User::find(3);
 $user = User::whereId(3)->with('courses')->get();
 ddd($user->load('courses'));
});
