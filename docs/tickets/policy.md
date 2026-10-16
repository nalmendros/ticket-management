# User Permissions

## Funcionalidad

La funcionalidad de los permisos para el sistema de ticket nos permite diferencias entre un usuario normal y un administrador. 

Cada rol separa las acciones permitidas del sistema.

## Function isAdmin()

La función isAdmin() aplicada en App\Models\User.php nos permite usarla para verificar si el usuario autenticado tiene el rol de administrador.

``
public function isAdmin(): bool {
        return $this->role === 'admin';
    }
``

## Blade

Esta condición permite la visibilidad de la ruta solo para al administrador.

``
@if (auth()->user()->isAdmin())
    <x-nav-link :href="route('ticket.control')" :active="request()->routeIs('ticket.control')">
    {{ __('Tickets Control') }}
    </x-nav-link>
@endif
``

## Policies

Las Policies nos permiten organizar lógica de los permisos en un Modelo.

```sh
./vendor/bin/sail php artisan make:policy TicketPolicy
```

### Funcionalidad de las Policies

Cuando se crea un archivo, también se crean las funcionalidades básicas: CRUD.

``
App\Policies\TicketPolicy.php

public function update(User $user, Ticket $ticket): Response
    {
        return ($user->id === $ticket->created_by || $user->isAdmin())
            ? Response::allow()
            : Response::deny('You do not own this Ticket.');
    }
``
``
App\Http\Controllers\TicketController.php

public function update(Request $request, $id)
{
    if ($request->user()->cannot('update', $ticket)) {
        abort(403);
    }
}
``

En este caso solo pueden actualizar el ticket el administrador o el creador del ticket.




