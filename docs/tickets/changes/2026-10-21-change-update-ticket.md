# Cambio: Mejora de control al actualizar un Ticket

## Contexto

Incidencia reportada: 

``
He definido mejor el método Delete del TicketPolicy, mejorando la separación entre usuario admin y usuario normal.
``

## Problema detectado

No estaba del todo organizado al usar el TicketPolicy en el Controlador (TicketController). En vez de poner en el controlador la verificación si el usuario es admin o no, se ha modificado y actualizado en el TicketPolicy.

## Solución aplicada

Flujo actual:

``
TicketPolicy.php

if ($user->isAdmin()) {
    return true;
}

return $ticket->user_id === $user->id;

``

``
TicketController.php

public function update(Request $request, $id)
{
    
    $ticket = Ticket::findOrFail($id);
    $this->authorize('update', $ticket);

    $user = $request->user();

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
    ]);

    $ticket->title = $validated['title'];
    $ticket->description = $validated['description'];

    if (user()->isAdmin()) {
        $adminData = $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:' . implode(',', Ticket::STATUSES),
            'priority' => 'required|in:' . implode(',', Ticket::PRIORITIES),
        ]);

        $ticket->assigned_to = $adminData['assigned_to'];
        $ticket->status = $adminData['status'];
        $ticket->priority = $adminData['priority'];
    }

    $ticket->save();
    
    return redirect()->route('ticket.show', $ticket->id)->with('success', 'Ticket updated successfully.');
}
``

## Respuesta ligera

Ahora el código se ha mejorado y optimizado.