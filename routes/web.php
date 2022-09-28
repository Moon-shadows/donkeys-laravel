<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UpladController;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

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

Route::get('/', function () {
    return view('index');
});




//Route::get('/index', [ImageController::class, 'uploadForm']);
//Route::post('/logoform', [ImageController::class, 'uploadFile'])->name('upload');


//Route::get('upload', [UploadController::class,'uploadForm']); 


/*Marcus:
Route::get('/', function () {
    return view('welcome');
});
Route::get('upload/', function () {
    return view('upload');
});
Route::post('view/', [ImageSave::class, 'processImage']);
Route::get('debug', function () {
    return view('debug');
});
*/
  

