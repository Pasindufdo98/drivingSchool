<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\resultController;
use App\Http\Controllers\Student_access_Controller;
use App\Http\Controllers\Tutor_access_Controller;
use App\Http\Controllers\stdResultController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contactus', function () {
     return view('contactus');
   
});

Route::get('/rates', function () {
    return view('rates');
  
});



// Route::get('/admin',[UserController::class,'index']);
  

Route::get('/admin/createUser', function () {
    return view('admin.createUser');
  
});

// Route::get('/quiz', function () {
//     return view('Student.quiz');
  
// });


// Route::get('/student_access', [App\Http\Controllers\Student_access_Controller::class, 'showDash'])->name('student_access');




Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('students', StudentController::class);
    Route::resource('notices', noticeController::class);
    Route::resource('results', resultController::class);

    Route::get('/studentaccess',[Student_access_Controller::class,'showDash'])->name('student_access');
    
    Route::get('/quiz',[Student_access_Controller::class,'showQuiz'])->name('quiz');
    Route::get('/pastpapers',[Student_access_Controller::class,'showPP'])->name('pp');
    Route::get('/exam',[stdResultController::class,'showResult'])->name('exam');
   
    Route::get('/tutoraccess',[Tutor_access_Controller::class,'showDashTutor'])->name('tutoraccess');

});


