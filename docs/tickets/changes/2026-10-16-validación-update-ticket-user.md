# Cambio: solo visibilidad de los tickets asignados

## Contexto

Incidencia reportada: 

``
La validación de la edición del ticket no se podía actualizar.
``

## Problema detectado

El usuario normal no podía actualizar los datos del ticket porque solo puede editar el título y la descripción. En los campos de la función a la hora de validar, había registrado también los campos que el usuario normal no puede. Entonces saltaba un error.

## Solución aplicada

Se añadió la condición que si el usuario autenticado es admin, podía actualizar todos los otros campos que el usuario normal no.

Flujo actual:

``
$validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        $ticket->title = $validated['title'];
        $ticket->description = $validated['description'];

        if ($request->user()->isAdmin()) {
            $adminData = $request->validate([
                'assigned_to' => 'nullable|exists:users,id',
                'status' => 'required|in:pending,in_progress,resolved',
                'priority' => 'required|in:low,medium,high',
            ]);

            $ticket->assigned_to = $adminData['assigned_to'];
            $ticket->status = $adminData['status'];
            $ticket->priority = $adminData['priority'];
        }
``

## Respuesta ligera

Dependiendo de la persona autenticada, se ha añadido la condición de que si es user solo se le validan los campos permitidos (título y descripción).