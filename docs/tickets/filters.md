# Filtros Ticketing en panel de Control (Admin)

## Implementación

Para el panel de control del administrador donde hay la lista de todos los tickets, he implementado tres maneras de filtrado; usuario asignado, estado y prioridad.

## Funcionalidad

Cada filtro es un desplegable donde aparecen las opciones posibles de cada. 
Se selecciona a petición del usuario, he integrado un botón que da la función de búsqueda y luego otro para borrar los filtros.

## Flujo actual

``
$users = $request->searchUser;
$statuses = $request->searchStatus;
$priorities = $request->searchPriority;

$tickets = Ticket::query()
    ->byUsers($users)
    ->byStatuses($statuses)
    ->byPriorities($priorities)
    ->get();
``

