# Cambio: creación de un ticket con un campo nullable

## Contexto

Incidencia reportada: 

``
La propiedad cascadeOnDelete() en la migración puede conllevar a pérdida de datos a la hora de borrar el ticket o usuario.
``

## Problema detectado

La relación de los usuarios con los tickets pueden ser borrados cuando se ejecuta la función de eliminar un usuario o un ticket. 

## Solución aplicada

Se eliminó deleteOnCascade() y se añadirá en la función de Delete del controlador del ticket una condición.

Flujo actual: 

``$table->foreignId('assigned_to')->constrained('users')->nullable();
``

## Respuesta ligera

La condición será que no se podrán eliminar usuario que tengan asignado tickets y viceversa.