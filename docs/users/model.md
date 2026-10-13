# Modelo de User

## Modelo principal

- Modelo: App\Models\User.php
- Tabla: App\database\migrations\0001_01_01_000000_create_users_table.php

## Responsabilidad

El modelo representa los usuarios que crean o son asignados en los tickets.

## Relaciones

- Tickets: tickets

```sh
public function isAdmin()
    {
        return $this->role === 'Admin';
    }
```

Los usuarios que son administradores pueden asignar, crear, leer, actualizar y eliminar tickets. Por lo tanto, un usuario que no tiene el rol de administrador, no le es posible poder modificar los tickets.

```sh
public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
```
Un usuario crea varios tickets.

## Datos sensibles

- password
- role

## Datos operativos no cifrados

- name
- email


