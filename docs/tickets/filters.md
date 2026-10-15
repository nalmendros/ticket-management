# Filtros Ticketing en panel de Control (Admin)

## Implementación

Para el panel de control del administrador donde hay la lista de todos los tickets, he implementado tres maneras de filtrado; usuario asignado, estado y prioridad.

## Funcionalidad

Cada filtro es un desplegable donde aparecen las opciones posibles de cada. 
Se selecciona a petición del usuario, he integrado un botón que da la función de búsqueda y luego otro para borrar los filtros.

## Flujo actual

``
$query = Ticket::query();

        if ($request->searchStatus) {
            $query->where('status', $request->searchStatus);
        }
        if ($request->searchPriority) {
            $query->where('priority', $request->searchPriority);
        }
        if ($request->searchUser) {
            $query->where('assigned_to', $request->searchUser);
        }
        
        if (!auth()->check() | !auth()->user()->isAdmin()) {
            abort(403);
        } 
        $users = User::all();
        $tickets = $query->get();

        return view('tickets.control', compact('tickets', 'users'));
``

