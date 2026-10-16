# Modelo de Ticket

## Modelo principal

- Modelo: App\Models\Ticket.php
- Tabla: App\database\migrations\2026_10_13_131815_create_tickets_table.php

## Responsabilidad

El modelo representa los tickets que se han creado y se han asignado a los usuarios. Sirven para comunicar incidencias, clasificadas en estado y prioridad.
La creación conlleva obligatoriamente los campos de Título y una Descripción.

## Relaciones

- Usuarios: users

```sh
public function createdBy()
    {
        return $this->belongsTo(User::class);
    }
```

Cada Ticket es creado por un usuario.

```sh
public function assignedTo()
    {
        return $this->hasOne(User::class);
    }
```
Cada Ticket es asignado a un usuario.

## TicketController

`` App\Http\Controllers\TicketController.php `` he añadido una función además de las básicas (CRUD). 

- ticketControl(): redirige a la vista del panel de control del usuario admin. La funcionalidad es que tiene la condición que solo el admin puede visualizar. Un usuario normal no.


