# Cambio: Botón de Delete y Eficacia en las acciones de los tickets

## Contexto

1a Incidencia reportada: 

``
Un usuario normal no tiene acción de poder borrar un ticket, solamente si el ticket está asignado a él y está resuelto. Un usuario administrador puede eliminar tickets si este no está asignado a nadie. 
``

2a Incidencia reportada:

``
Para mejorar la experiencia del usuario, se ha considerado en quitar ventanas y poder realizar las acciones de los tickets en una sola celda de la tabla.
``

## Problema detectado

1.El usuario no puede borrar un ticket cualquiera, debe de estar asignado a él y con el status pendiente. El administrador puede borrar un ticket si este no está asignado a ningún usuario.
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
``
<div class="flex gap-2">
    <a href="{{ route('ticket.show', $ticket->id )}}" class="cursor-pointer p-3 rounded-xl hover:bg-[#333333] hover:text-white transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
    </svg></a>
    <form method="POST" action="{{ route('ticket.destroy', $ticket->id) }}" onsubmit = "return confirm('Are you sure you want to delete this ticket?')">
        @csrf
        @method('DELETE')
        <button value="delete" class="hover:bg-red-400 p-2.5 rounded-xl transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>
        </button>
    </form>
    <a href="{{ route('ticket.edit', $ticket->id) }}" class="hover:bg-blue-300 p-3 rounded-xl transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
    </svg>
    </a>
</div>
``


## Respuesta Ligera

1.Se muestra el boton de eliminar ticket al usuario normal y se han añadido algunas condiciones más para que este pueda borrar.
2.Los botones de acción se han cambiado de lugar, ahora están en una sola columna; Actions