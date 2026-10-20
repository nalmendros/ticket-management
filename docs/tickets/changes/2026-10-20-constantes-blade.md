# Cambio: Actualización vistas con las constantes

## Contexto

Incidencia reportada: 

``
El uso de las CONSTANTES no se habian implementado correctamente a las vistas y a las validaciones.
``

## Problema detectado

Los errores de visualización de los campos de Status y Prioridad se habian corregido una primera vez implementando el Str::headline. 
Se ha vuelto a corregir de forma que ahora las constantes estan escritas correctamente y se han añadido a las validaciones y a la tabla de migración para que todo el sistema de ticket se visualice igual en todas las vistas.

## Solución aplicada

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