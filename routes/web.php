<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function() {
    return view('layouts.dashboard');
});

Route::get('/tickets', [TicketController::class, 'index'])->name('index');
//Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('show');
Route::get('/tickets/create', [TicketController::class, 'create'])->name('create');
Route::get('ticket/{id}/edit', [TicketController::class, 'edit'])->name('edit');
Route::post('/tickets', [TicketController::class, 'store'])->name('store');
Route::put('/tickets', [TicketController::class, 'update'])->name('update');
Route::delete('/tickets/{id}', [TicketController::class, 'delete'])->name('delete');
