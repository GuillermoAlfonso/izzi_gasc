<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'authenticate'])
        ->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('registrar_producto', [Controller::class, 'create'])
        ->name('registrar_producto');

    Route::post('registrar_producto', [Controller::class, 'store']);

    Route::get('mostrar-productos', [Controller::class, 'showProducts'])
        ->name('mostrar-productos');

    Route::post('eliminar_producto', [Controller::class, 'destroy'])
        ->name('eliminar_producto');

    Route::get('editar_producto', [Controller::class, 'edit'])
        ->name('editar_producto');

    Route::post('form-editar-producto', [Controller::class, 'editForm'])
        ->name('form-editar-producto');

    Route::get('generar-reportes', [Controller::class, 'createReportes'])
        ->name('generar-reportes');

    Route::post('generar_reporte', [Controller::class, 'generarReportes'])
        ->name('generar_reporte');

    Route::post('descarga_bd', [Controller::class, 'descargaMasiva'])
        ->name('descarga_bd');
});
