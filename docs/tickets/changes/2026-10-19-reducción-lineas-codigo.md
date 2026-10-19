# Cambio: Reducción de lineas de código

## Contexto

Incidencia reportada: 

``
Había una función con más lineas de código de las que se necesitaba.
``

## Problema detectado

Había una función con una condición que se podía resumir.

## Solución aplicada

Se ha implementado una reducción de lineas.

## Flujo anterior

``
if ($request->filled('searchUser')) {
    if ($request->searchUser === 'null') {
        $query->whereNull('assigned_to');
    } else {
        $query->where('assigned_to', $request->searchUser);
    }
}
``

## Flujo actual

``
if ($request->filled('searchUser')) {
    $request->searchUser === 'null'
        ? $query->whereNull('assigned_to')
        : $query->where('assigned_to', $request->searchUser);
}
``

## Respuesta Ligera

Con la misma funcionalidad se ha podido implementar una mejora de código y además reducción de líneas.