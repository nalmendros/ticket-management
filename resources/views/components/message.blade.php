@props(['type' => 'error', 'message' => null])

<div class="message message-{{ $type }}">
    <p>{{ $message }}</p>
</div>