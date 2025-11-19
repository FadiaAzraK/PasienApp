<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VisitController;

Route::get('/', function(){ return redirect()->route('patients.index'); });

Route::resource('patients', PatientController::class);
Route::post('patients/filter', [PatientController::class, 'filter'])->name('patients.filter');

Route::get('visits', [VisitController::class,'index'])->name('visits.index');
Route::get('visits/create', [VisitController::class,'create'])->name('visits.create');
Route::post('visits', [VisitController::class,'store'])->name('visits.store');
Route::get('visits/{visit}', [VisitController::class,'show'])->name('visits.show');
Route::post('visits/filter', [VisitController::class, 'filter'])->name('visits.filter');

Route::get('/patients/export/pdf', [PatientController::class, 'exportPdf'])->name('patients.export.pdf');
Route::get('/visits/export/excel', [VisitController::class, 'exportExcel'])->name('visits.export.excel');