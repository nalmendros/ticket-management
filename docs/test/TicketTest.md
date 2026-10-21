# Ticket Test

## Definición

Se ha creado un archivo de test (Feature Test) para poder comprobar peticiones HTTP y así verificar los accesos.

```sh
./vendor/bin/sail php artisan make:test TicketTest
```

### Test

- Un usuario normal intenta eliminar un ticket creado por otro usuario.
- Un usuario normal intenta modificar el estado, prioridad o responsable de un ticket mediante una petición HTTP, aunque esos campos no estén disponibles en su formulario.
- Un usuario normal intenta consultar o modificar un ticket ajeno utilizando directamente su identificador.
- Un administrador realiza operaciones autorizadas sobre tickets de otros usuarios.
- Un usuario normal elimina correctamente un ticket propio que está pendiente y sin responsable asignado.
- Un usuario normal intenta eliminar un ticket propio que ya tiene responsable asignado o cuyo estado no es pendiente.

## Bloqueos

Ha habido un bloqueo porque no acababa de entender cómo cambiando solo un campo el test me daba pasaba correctamente.

## Solución

La solución que se ha implementado ha sido ir poniendo lineas de Log en las partes de código donde se ha querido comprobar el valor y en qué métodos se accedia. Al final no habia ningún problema sino que se ha llegado a la conclusión que lo que quería comprobar sí funciona realmente y por eso el test pasaba bien.

## Usabilidad

``
./vendor/bin/sail php artisan test --filter=TicketTest
``