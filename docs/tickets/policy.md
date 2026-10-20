# Ticket Policy

## Definición

La creación de una policy sobre un modelo nos permite controlar los permisos de cada acción del modelo.

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