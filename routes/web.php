<?php


use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\UserProfileUpdateController;
use App\Models\Comment;
use App\Models\Notice;
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

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/update/user/profile', [UserProfileUpdateController::class, 'index'])->name('update.profile');
});

Route::put('/update/profile/{user}/user', [UserProfileUpdateController::class, 'update'])->name('user.profile.update');




Route::middleware('roleAuthenticate')->group(function () {
    Route::resource('course', CourseController::class);
    Route::get('/enroll/{course}', [CourseController::class, 'enroll'])->name('enroll');
    Route::put('/enroll/attach/{user}', [CourseController::class, 'attach'])->name('course.attach');
    Route::delete('/enroll/detach/{user}', [CourseController::class, 'detach'])->name('course.detach');
    Route::get('/courses/{course}/notice', [NoticeController::class, 'index'])->name('course.notices');
    Route::post('/courses/{course}/notice/create', [NoticeController::class, 'store'])->name('notice.store');
    Route::delete('/course/notices/{notice}/delete', [NoticeController::class, 'destroy'])->name('notice.delete');
});


// View Notice Student

Route::get('/notice/view/{user}', [NoticeController::class, 'show'])->name('notice.show');







Route::get('/course/{course}/comments', [CommentController::class, 'index'])->name('comments');
Route::post('/course/comments', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/course/{comment}/delete/comment', [CommentController::class, 'destroy'])->name('comment.delete');


Route::get('/course/{course}/enrolled/student', [HomeController::class, 'studentList'])->name('student.list');


// Payment 

Route::get('/payment/{course}', [PaymentController::class, 'index'])->name('payment.create');
Route::post('/payment/{course}', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/course/repayment/{payment}', [PaymentController::class, 'edit'])->name('payment.edit');
Route::PUT('/course/repayment/{payment}', [PaymentController::class, 'update'])->name('payment.update');


// Manage Payment Teacher


Route::get('/manage/payments', [PaymentController::class, 'manage'])->name('payment.manage');
Route::put('/manage/payments/{payment}/update', [PaymentController::class, 'paymentDecision'])->name('payment.update.decide');

// Manage Payment Teacher

// Manage Progress Teacher

Route::get('/manage/progress/certificate', [ProgressController::class, 'view_certificate'])->name('manage.progress.certificate');
Route::put('upload/progress/{progress}/certificate', [ProgressController::class, 'certificate_upload'])->name('certificate.upload');

// Manage Progress Teacher






// Progress 

Route::get('/progress/{course}/course', [ProgressController::class, 'index'])->name('progress.index');
Route::post('/progress/{course}/course', [ProgressController::class, 'store'])->name('progress.store');
Route::PUT('/course/{progress}/progress/update', [ProgressController::class, 'update'])->name('progress.update');
Route::PUT('/course/{progress}/certificate', [ProgressController::class, 'certificate'])->name('progress.certificate');










Route::get('/hello', function () {
    $user = auth()->user();
    $user->load('enroll');


    // $user = User::find(3);
    $user = User::whereId(3)->with('courses')->get();
});


Route::get('/test', function () {

    $user = User::find(4);
    $user = User::whereId(3)->with('courses')->first();
    $data[1] = $user->courses->user_id;
    $user->courses[1]->price;
    ddd($user);
});

Route::get('/input', function () {
    return view('input');
});