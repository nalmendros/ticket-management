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

## Respuesta ligera

Ahora si se quiere acceder a los Status y Priorities se puede hacer mediante las constantes; $ticket->status = Ticket::STATUSES/PRIORITIES;