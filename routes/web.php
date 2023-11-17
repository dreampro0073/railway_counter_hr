<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntryContoller;
use App\Http\Controllers\MassageController;
use App\Http\Controllers\LockerController;

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


Route::get('/', [UserController::class,'login'])->name("login");
Route::post('/login', [UserController::class,'postLogin']);


Route::get('/logout',function(){
	Auth::logout();
	return Redirect::to('/');
});

Route::group(['middleware'=>'auth'],function(){
	Route::group(['prefix'=>"admin"], function(){
		// Route::get('/print-post', [UserController::class,'printPost']);
		Route::get('/dashboard',[AdminController::class,'dashboard']);
		

		Route::group(['prefix'=>"sitting"], function(){
			Route::get('/',[AdminController::class,'sitting']);
			Route::get('/print/{id?}', [EntryContoller::class,'printPost']);
			Route::get('/print-report', [EntryContoller::class,'printReports']);

		});
		Route::group(['prefix'=>"massage"], function(){
			Route::get('/',[MassageController::class,'massage']);
			Route::get('/print/{id?}', [MassageController::class,'printPost']);
			
		});
		Route::group(['prefix'=>"locker"], function(){
			Route::get('/',[LockerController::class,'index']);
			Route::get('/print/{id?}', [LockerController::class,'printPost']);
			
		});
	});
});

Route::group(['prefix'=>"api"], function(){
	Route::group(['prefix'=>"sitting"], function(){
		Route::post('/init',[EntryContoller::class,'initEntries']);
		Route::post('/edit-init',[EntryContoller::class,'editEntry']);
		Route::post('/store',[EntryContoller::class,'store']);
		Route::post('/cal-check',[EntryContoller::class,'calCheck']);
	});

	Route::group(['prefix'=>"massage"], function(){
		Route::post('/init',[MassageController::class,'initMassage']);
		Route::post('/edit-init',[MassageController::class,'editMassage']);
		Route::post('/store',[MassageController::class,'store']);
		Route::post('/change-time',[MassageController::class,'changeTime']);
	});
	Route::group(['prefix'=>"locker"], function(){
		Route::post('/init',[LockerController::class,'initLocker']);
		Route::post('/edit-init',[LockerController::class,'editLocker']);
		Route::post('/store',[LockerController::class,'store']);
		Route::post('/cal-check',[LockerController::class,'calCheck']);
	});
});
