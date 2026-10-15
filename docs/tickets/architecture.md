# Arquitectura Ticket

## Objetivo

La arquitectura modular de ``Ticket`` permite organizar y reportar las incidencias que puedan haber internamente.

## Responsabilidades

### TicketController

Archivo: 

`` App\Http\Controllers\TicketController.php ``

Se registra las siguientes funcionalidad:

- index(): Permite acceder a la vista de los tickets asignados del usuarios
- show(): Permite acceder a los detalles específicos de un ticket
- create(): Permite acceder a la vista del formulario de creación del ticket
- store(): Permite realizar la creación del ticket, añadiendo la validación de los campos
- edit(): Permite acceder a la edición de un ticket
- update(): Permite actualizar los datos de un ticket
- destroy(): Permite eliminar un ticket, tiene la condición de no poder eliminar un ticket si este está asignado a algún usuario
- ticketControl(): Permite acceder al panel de control de tickets, trae una condición por el cual solo los usuarios con el rol de Admin puedan verlo.

## Routes

Rutas específicas para los tickets:

``
Route::get('/my-tickets', [TicketController::class, 'index'])->name('ticket.index');
Route::get('/tickets/create', [TicketController::class, 'create'])->name('ticket.create');
Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.store');
Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('ticket.destroy');
Route::get('/tickets-control', [TicketController::class, 'ticketControl'])->name('ticket.control');
``