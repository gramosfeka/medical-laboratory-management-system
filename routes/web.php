<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;

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


Auth::routes(['verify'=>true]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::redirect('/', '/login')->name('index');

Route::prefix('users')->middleware(['auth','is_admin'])->group(function () {
Route::get('/index', [UserController::class, 'index'])->name('users.index');
Route::get('/datatable', [UserController::class, 'datatable'])->name('users.datatable');
Route::get('/create', [UserController::class, 'create'])->name('users.create');
Route::post('/store', [UserController::class, 'store'])->name('users.store');
Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/{user}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
});


Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

});



Route::prefix('tests')->middleware('auth')->group(function () {
Route::get('/index', [TestController::class, 'index'])->name('tests.index')->middleware('is_admin');
Route::get('/create', [TestController::class, 'create'])->name('tests.create');
Route::get('/testsdatatable', [TestController::class, 'testsdatatable'])->name('tests.testsdatatable');
Route::get('/{test}/single', [TestController::class, 'single'])->name('tests.single');
Route::get('/show', [TestController::class, 'show'])->name('tests.show');
Route::get('/datatable', [TestController::class, 'datatable'])->name('tests.datatable')->middleware('is_admin');
Route::post('/store', [TestController::class, 'store'])->name('tests.store')->middleware('is_admin');
Route::get('/{test}/edit', [TestController::class, 'edit'])->name('tests.edit')->middleware('is_admin');
Route::put('/{test}/update', [TestController::class, 'update'])->name('tests.update')->middleware('is_admin');
Route::delete('/{test}/destroy', [TestController::class, 'destroy'])->name('tests.destroy')->middleware('is_admin');
});




Route::prefix('appointments')->middleware('auth')->group(function () {
Route::get('/index', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::get('/datatable', [AppointmentController::class, 'datatable'])->name('appointments.datatable');
Route::get('/pendingdatatable', [AppointmentController::class, 'pendingdatatable'])->name('appointments.pendingdatatable');
Route::get('/pending', [AppointmentController::class, 'pending'])->name('appointments.pending');
Route::get('/approveddatatable', [AppointmentController::class, 'approveddatatable'])->name('appointments.approveddatatable');
Route::get('/approved', [AppointmentController::class, 'approved'])->name('appointments.approved');
Route::get('/sample_collecteddatatable', [AppointmentController::class, 'sample_collecteddatatable'])->name('appointments.sample_collecteddatatable');
Route::get('/sample_collected', [AppointmentController::class, 'sample_collected'])->name('appointments.sample_collected');
Route::get('/waitingdatatable', [AppointmentController::class, 'waitingdatatable'])->name('appointments.waitingdatatable');
Route::get('/waiting', [AppointmentController::class, 'waiting'])->name('appointments.waiting');
Route::get('/result_senddatatable', [AppointmentController::class, 'result_senddatatable'])->name('appointments.result_senddatatable');
Route::get('/result_send', [AppointmentController::class, 'result_send'])->name('appointments.result_send');
Route::get('/testdatatable', [AppointmentController::class, 'testdatatable'])->name('appointments.testdatatable');
Route::post('/store', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('/{appointment}/update', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/{appointment}/destroy', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
Route::get('/getFreeEvents', [AppointmentController::class, 'getFreeEvents'])->name('appointments.getFreeEvents');
Route::get('/download/{id}', [AppointmentController::class, 'download'])->name('appointments.download');

});



