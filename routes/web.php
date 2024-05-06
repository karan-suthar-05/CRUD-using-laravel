<?php

use App\Http\Controllers\authentication;
use App\Http\Controllers\noteController;
use App\Http\Controllers\renderPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/",[renderPage::class,'home'])->name("home");
Route::get("/registration",[renderPage::class,'registrationPage'])->name('note.registration');
Route::get("/login",[renderPage::class,'loginPage'])->name('note.login');


// manage auth
Route::group([],function(){
    Route::post('/register',[authentication::class,'register'])->name('note.register');
    Route::post('/userlogin',[authentication::class,'login'])->name('note.userlogin');
    Route::get('/logout',[authentication::class,'logout'])->name('note.logout');
});

// manage notes
Route::group(['middleware' => 'guard'],function(){
    Route::get("/note",[renderPage::class,'index'])->name("note");
    Route::post('/add',[noteController::class,'addNote'])->name("note.add");
    Route::get('/add',function()
    {
        return view("404");
    });
    Route::post('/edit',[noteController::class,'editNote'])->name("note.edit");
    Route::get('/edit',function(){
        return view("404");
    });
    Route::get('/delete/{id}',[noteController::class,'deleteNote'])->name("note.delete");
});
