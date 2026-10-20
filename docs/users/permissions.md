# User Permissions

## Objetivo

Diferenciar los permisos de los usuarios nos permiten controlar y organizar bien las acciones permitidas que puede ejecutar un usuario. En este sistema de tickets se ha implementado dos roles; Admin y User.

- Admin: Tiene total permisos.
- User: Solo le es permitido ver su propio panel con sus tickets creados, eliminar ciertos tickets, editar ciertos campos y visualizar sus propios tickets.

### Función

Cuando se crea un archivo, también se crean las funcionalidades básicas: CRUD.

``
App\Models\User.php

public function isAdmin(): bool 
{
    return $this->role === 'admin';
}
``

La función creada en el modelo de User al principio, permite usarlo como booleano y así diferenciar los usuarios.

### Usabilidad

``
@if (auth()->user()->isAdmin())
    <x-nav-link :href="route('ticket.control')" :active="request()->routeIs('ticket.control')">
    {{ __('Tickets Control') }}
    </x-nav-link>
@endif
``

Ruta que solo puede ver el usuario con rol de Admin.