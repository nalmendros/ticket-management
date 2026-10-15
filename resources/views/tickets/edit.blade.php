<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit Ticket') }}
    </h2>
</x-slot>
<div style="display: flex; align-items: center;">

    <form method = "POST" action="{{ route('ticket.update', $ticket->id) }}" style="margin-top: 50px">
        @csrf
        @METHOD('PUT')
        <label for="title">Title</label>
        <input name="title" type="text" id="title" value="{{ $ticket->title }}">
        <label for="description">Description</label>
        <textarea name="description" value="{{ $ticket->description }}" id="description" type="text">{{ $ticket->description }}</textarea>
        <label for="assigned_to">Assign User</label>
        <select id="assigned_to" name="assigned_to">
            
            @forelse ($users as $user)
                @if($user->id == $ticket->assigned_to)
                <option value="{{ $user->id }}" selected>{{ $user->name}}</option>
                @else
                <option value="{{ $user->id }}" >{{ $user->name }}</option>
                @endif
            @empty
            <p>There's no users to assign</p>
            @endforelse
        </select>   
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="{{ $ticket->status }}" selected>{{ $ticket->status }}</option>
            <option value="pending">Pending</option>
            <option value="in_process">In Process</option>
            <option value="resolved">Resolved</option>
        </select>
        <label for="priority">Priority</label>
        <select id="priority" name="priority">
            <option value="{{ $ticket->priority }}" selected>{{ $ticket->priority }}</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
        <button value="create" id="button">Confirm Edit</button>
    </form>
</div>
@if (session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error )
        <li>{{ $error }}</li>
    @endforeach
@endif
</x-app-layout>