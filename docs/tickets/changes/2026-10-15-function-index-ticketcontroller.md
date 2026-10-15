# Cambio: solo visibilidad de los tickets asignados

## Contexto

Incidencia reportada: 

``
La función redirige a la vista así pudiendo solo ver los propios tickets asignados del usuario autenticado. 
``

## Problema detectado

Antes se podían ver todos los tickets independientemente del rol del usuario.

## Solución aplicada

Se añadió más condiciones para que la visualización del panel sean solo tickets asignados a la persona autenticada.

Flujo actual:

``
$user = Auth::id();
$tickets = Ticket::where('assigned_to', $user)->get();
``

## Respuesta ligera

Ahora la función index() solo se listarán los tickets asignados al usuario autenticado.