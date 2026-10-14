# Cambio: relación ticket con los usuarios asignados

## Contexto

Incidencia reportada: 

``
La relación que se habia definido la primera vez no es la correcta para la relación que se está creando entre ticket y usuario. 
``

## Problema detectado

Antes, $this->hasOne(User::class) significa que el ticket tiene pero asignar el ticket significa que pasa a pertenecer a un usuario. 

## Solución aplicada

Se cambió la relación de los tickets asignados.

Flujo actual: 

``return $this->belongsTo(User::class);``

## Respuesta ligera

Los tickets son asignados a una persona, por lo tanto le pertenecen a una persona.