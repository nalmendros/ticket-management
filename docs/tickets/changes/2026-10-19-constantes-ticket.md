# Cambio: Eliminación de código PHP en Blade

## Contexto

Incidencia reportada: 

``
Para el array de status y priority de un ticket, se habia implementado un array directamente en el blade. Cosa que en un futuro no es muy óptimo.
``

## Problema detectado

Los valores de las columnas de Status y Priority de un ticket se habian implementado directamente en el blade para acceder a ellos en la selección. Para un futuro esa opción no es muy óptima.

## Solución aplicada

Se han añadido constantes en el modelo Ticket de los posibles Status y Priority.

Flujo actual:

``
App\Models\Ticket.php

const STATUSES = [
    'pending',
    'in_process',
    'resolved'
];

const PRIORITIES = [
    'low',
    'medium',
    'high'
];

``

``
2026_10_13_131815_create_tickets_table.php

$table->enum('status', \App\Models\Ticket::STATUSES);
$table->enum('priority', \App\Models\Ticket::PRIORITIES);
``

``
App\Http\Controllers\TicketController.php

'status' => 'required|in:' . implode(',', Ticket::STATUSES),
'priority' => 'required|in:' . implode(',', Ticket::PRIORITIES),

- Implode: Junta los elementos del array en un string separado en comas.

``

## Respuesta ligera

Los valores de Status y Priority se verán reflejados de manera igual en todas las vistas del blade sin tener que añadir ninguna linea de código para formatearlas.