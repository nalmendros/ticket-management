# Cambio: Variable mejorada para el uso

## Contexto

Incidencia reportada: 

``
La variable debería de poder leerse de manera que se sepa qué hace.
``

## Problema detectado

El archivo TicketController de la función Index. Hay la varialbe $user que su función es buscar la ID del usuario autenticado

## Solución aplicada

Cambiar el nombre de la variable.

## Flujo actual

``
$userId = Auth::id();
``

## Respuesta Ligera

Se ha cambiado el nombre de la variable con tal que indique la acción que hace.