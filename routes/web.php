<?php

use App\Models\User;
use App\Models\ExcelOne;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UploadTestFile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelOneController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('Dashboard');
})->name('dashboard');




//File upload route list start
Route::get('ajax_request', function () {
    return view('file_upload.ajax_file_request');
})->name('ajax_file_request');

Route::post('add-file-to-server', function (Request $request) {

    $uploadedFile = $request->file('attached_file');
    $originalName = $uploadedFile->getClientOriginalName();

    $fileType = $uploadedFile->getClientOriginalExtension();
    $filename = time() . '_' . date('Y-m-d') . '_test_file' . '.' . $fileType;

    if ($files = $request->file('attached_file')) {
        $files->move(storage_path('/app/public/test_folder/'), $filename);
    }

    $attachment = UploadTestFile::create([
        'original_name' => $originalName,
        'path' => 'test_folder/' . $filename,
        'extention' => $fileType,
        'rename_name' => $request->attached_file_name,
    ]);

    return true;
})->name('ajax_file_request');
//File upload route list end

//excel file upload start
Route::get('add-excel-file-to-server-create',[ExcelOneController::class,'excelInportCreate']);
Route::post('add-excel-file-to-server-store',[ExcelOneController::class,'excelInportStore']);
//excel file upload end