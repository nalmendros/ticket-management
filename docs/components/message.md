# Componente Message

## Función

Resources\Views\Components\message.blade.php

Se ha creado el componente de messages.blade.php para que a la hora de implementarlo en cualquier vista sea más fácil de hacer algun cambio por ejemplo del estilo o del tipo de mensaje. Por ahora solo registra de dos tipos; "success" y "error".

## Componente

``
@props(['type' => 'error', 'message' => null])

<div class="message message-{{ $type }}">
    <p>{{ $message }}</p>
</div>
``

- Si no se le pasa ningun tipo se utiliza error predeterminado
- Si no se pasa ningun valor en message, el valor es null

## Usabilidad

``
@if (session('success'))
    <x-message type='success' :message="session('success')" />
@endif
@if (session('error'))
    <x-message type='error' :message="session('error')" />
@endif
``

## Estilo Actual

``
Resources\css\app.css

.message-success p {
    color: green;
    border: 2px solid rgb(1, 83, 1);
    border-radius: 8px;
    font-size: 18px;
    padding: 5px;
    margin-top: 5px;
}
.message-error p {
    color: red;
    border: 2px solid rgb(177, 1, 1);
    border-radius: 8px;
    font-size: 18px;
    padding: 5px;
    margin-top: 5px;
}
``