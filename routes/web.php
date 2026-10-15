<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $tickets = App\Models\Ticket::all();
    return view('tickets.list', compact('tickets'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('ticket.destroy');
});

require __DIR__.'/auth.php';
