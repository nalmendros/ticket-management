# Cambio: Implementación de la función de Delete de TicketPolicy al TicketController

## Contexto

Incidencia reportada: 

``
El uso de la función de Delete del TicketController no estaba bien definido a la hora de especificar los permisos y diferenciar el rol de cada usuario.
``

## Problema detectado

El problema que habia es que la definición de los permisos de cada tipo de usuario no se acababan de integrar bien a la hora de usar el metodo Delete. 

## Solución aplicada

Como ya se habia creado un TicketPolicy para manejar los permisos, se ha añadido en la función de Delete del TicketController, la Policy de delete. Por lo tanto, solo hay que usar el método de la policy en el controlador. 

## Flujo actual

``
App\Http\Controllers\TicketController.php

if ($request->user()->cannot('delete', $ticket)) {
    return redirect()->back()->with('error', 'This ticket is assigned or it is not resolved.');
} else {
    $ticket->delete();
    return redirect()->back()->with('success', 'Ticket deleted successfully.');
}
``

``
Policies\TicketPolicy.php

public function delete(User $user, Ticket $ticket): bool
{
    if($user->role === 'admin') return true;

    if($user->role === "user" && $ticket->status === "pending" && !$ticket->assigned_to) return true;

    return false;
}
``

## Respuesta Ligera

Ahora se va a poder reutilizar la Policy sin tener que copiar y pegar el código que se habia creado anteriormente.