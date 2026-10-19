# Cambio: Optimización de Filtros

## Contexto

Incidencia reportada: 

``
Los filtros de los tickets no eran suficientemente óptimos para un sistema de tickets.
``

## Problema detectado

El problema era que la función de búsqueda de tickets por filtros no eran suficientemente eficientes ya que ahora solo tenía un filtrado de 2 campos, si en un futuro se agranda, el método no acabaría siendo bueno.

## Solución aplicada

Se ha implementado Scopes. Una forma de poder encapsular lógica de consulta reutilizable directamente dentro de los modelos, en este caso App\Models\Ticket.php

## Flujo actual

``
App\Models\Ticket.php

public function scopeByStatuses($query, $status)
{
    if ($status)
        return $query->whereIn('status', (array) $status);
}

public function scopeByPriorities($query, $priority)
{
    if ($priority)
        return $query->whereIn('priority', (array) $priority);
}

public function scopeByUsers($query, $user)
{
    return $query->when($user, function ($query, $user) {
        return $user === 'null'
        ? $query->whereNull('assigned_to')
        : $query->where('assigned_to', $user);
    });
}
``

``
App\Http\Controllers\TicketController.php

$users = $request->searchUser;
$statuses = $request->searchStatus;
$priorities = $request->searchPriority;

$tickets = Ticket::query()
    ->byUsers($users)
    ->byStatuses($statuses)
    ->byPriorities($priorities)
    ->get();
``

## Respuesta Ligera

Con la misma funcionalidad se ha podido implementar una mejora de código y además reducción de líneas.