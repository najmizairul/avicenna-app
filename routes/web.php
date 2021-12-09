<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware(['auth:sanctum', 'verified'])->group(function() {

    Route::get('/dashboard', [DashboardController::class,  'index'])->name('dashboard');

    Route::prefix('pharmacy')->name('pharmacy.')->group(function() {
        Route::get('/dashboard', [DashboardController::class,  'pharmacyDashboard'])->name('dashboard');
        Route::get('/orders', [OrderController::class, 'pharmacyIndex'])->name('orders');
        Route::get('/stock', [StockController::class, 'pharmacyIndex'])->name('stock');
        Route::get('/collections', [CollectionController::class, 'pharmacyIndex'])->name('collections');
    });

    Route::prefix('doctors')->name('doctors.')->group(function() {
        Route::get('/dashboard', [DashboardController::class,  'doctorsDashboard'])->name('dashboard');
        Route::get('/patients', [PatientController::class, 'doctorsIndex'])->name('patients');
        Route::get('/patients/{code}', [PatientController::class, 'doctorsShow'])->name('patients.show');
        Route::post('/patients/{code}', [PatientController::class, 'doctorsFinishConsultation'])->name('patients.finishConsultation');

        Route::post('/patients/visits', [PatientController::class, 'seePatient'])->name('patients.see');
    });

    Route::prefix('reception')->name('reception.')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'receptionDashboard'])->name('dashboard');
        Route::get('/patients', [PatientController::class, 'receptionIndex'])->name('patients');
        Route::post('/patients/search', [PatientController::class, 'receptionSearch'])->name('patients.search');
        Route::post('/patients/assign-doctor', [PatientController::class, 'receptionAssignDoctor'])->name('patients.assignDoctor');
        Route::get('/patients/register', [PatientController::class, 'register'])->name('patients.register');
        Route::post('/patients/register', [PatientController::class, 'store'])->name('patients.register');
        Route::get('/patients/{code}', [PatientController::class, 'receptionShow'])->name('patients.show');

    });
});
