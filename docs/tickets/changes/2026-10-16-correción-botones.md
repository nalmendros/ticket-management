# Cambio: Botón de Delete y Eficacia en las acciones de los tickets

## Contexto

1a Incidencia reportada: 

``
Un usuario normal no tiene acción de poder borrar un ticket. Se ha cambiado porque si cada vez que se tiene que borrar un ticket por error, no se va a avisar al administrador cada vez. Se convierte en una tarea tediosa.
``

2a Incidencia reportada:

``
Para mejorar la experiencia del usuario, se ha considerado en quitar ventanas y poder realizar las acciones de los tickets en una sola celda de la tabla.
``

## Problema detectado

1.El usuario no puede borrar su propio ticket, debe de consultarlo al administrador.
2.La experiencia del usuario no es eficaz a la hora de pulsar los botones necesarios para realizar una acción.

## Solución aplicada

1.La visibilidad del botón de Delete, va a pasar a habilitado para el usuario normal, ya que también hay la segunda confirmación.
2.Diseñar los botones de acción en una misma celda.

## Flujo actual

1.
``
<form method="POST" action="{{ route('ticket.destroy', $ticket->id) }}" onsubmit = "return confirm('Are you sure you want to delete this ticket?')">
    @csrf
    @method('DELETE')
    <button value="delete" class="bg-red-500 hover:bg-red-400 p-2.5 rounded-xl transition duration-300">Delete</button>
</form>
``

2.


## Respuesta Ligera

Se ha eliminado la condición.