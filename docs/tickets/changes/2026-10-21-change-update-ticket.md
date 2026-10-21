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

if ($user->id === $ticket->created_by) return true;

return false;

``

``
TicketController.php

public function update(Request $request, $id)
{
    
    $ticket = Ticket::findOrFail($id);

    if ($request->user()->cannot('update', $ticket)) {
        return redirect()->back()
            ->with('error', 'You are not authorized to update this ticket.');
    }

    $user = $request->user();

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
    ]);

    $ticket->title = $validated['title'];
    $ticket->description = $validated['description'];

    if ($user->isAdmin()) {
        $adminData = $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:' . implode(',', Ticket::STATUSES),
            'priority' => 'required|in:' . implode(',', Ticket::PRIORITIES),
        ]);

        $ticket->assigned_to = $adminData['assigned_to'];
        $ticket->status = $adminData['status'];
        $ticket->priority = $adminData['priority'];
        return redirect()->route('ticket.control', $ticket->id)->with('success', 'Ticket updated successfully.');
    }

    $ticket->save();
    
    return redirect()->route('ticket.index', $ticket->id)->with('success', 'Ticket updated successfully.');
}
``

## Respuesta ligera

Ahora el código se ha mejorado y optimizado.