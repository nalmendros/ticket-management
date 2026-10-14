# Cambio: creación de un ticket con un campo nullable

## Contexto

Incidencia reportada: 

``
La creación del ticket para varios usuarios es que el administrador pueda asignar un ticket, pero un usuario normal no.

App\Database\Migrations\2026_10_13_131815_create_tickets_table.php
$table->foreignId('assigned_to')->constrained('users')->cascadeOnDelete();
``

## Problema detectado

Un usuario que no tenga el rol de administrador, no puede asignar usuarios al crear un ticket, por lo tanto el campo 'assigned_to' debe de ser nulable.

## Solución aplicada

Se añadió la propiedad nullable() en la migración.

Flujo actual: 

``$table->foreignId('assigned_to')->constrained('users')->cascadeOnDelete()->nullable();
``

## Respuesta ligera

Los tickets son asignados a una persona, por lo tanto le pertenecen a una persona.