<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuaranteeController;
use App\Http\Controllers\GuaranteeFileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('guarantee')->group(function () {
    Route::post('/', [GuaranteeController::class, 'store'])->name('guarantee.store');
    Route::get('/', [GuaranteeController::class, 'index'])->name("guarantee.index");
    Route::get('/create', [GuaranteeController::class, 'create'])->name("guarantee.create");
    Route::get("/upload", [GuaranteeFileController::class, 'upload'])->name("guarantee.upload");
    Route::post("/upload", [GuaranteeFileController::class, 'store'])->name("guarantee.store");

    Route::post('/files', [GuaranteeFileController::class, 'store'])->name('guarantee.files.store');
    Route::get('/{id}/details', [GuaranteeController::class, 'show'])->name('guarantee.details');
    Route::put('/update', [GuaranteeController::class, 'update'])->name('guarantee.update');
    Route::delete('/guarantee/{id}', [GuaranteeController::class, 'destroy'])->name('guarantee.delete');

    Route::get("/files", [GuaranteeFileController::class, 'files'])->name("guarantee.files");

    Route::get('/file/download/{id}', [GuaranteeFileController::class, 'downloadFile'])->name('guarantee.file.download');
});

require __DIR__ . '/auth.php';
