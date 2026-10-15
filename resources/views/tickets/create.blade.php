<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Ticket Create')}}
    </h2>
</x-slot>
<div class="p-12 justify-center">

    <form method = "POST" action="{{ route('ticket.store') }}" class="flex flex-col w-1/2">
        @csrf
            <label for="title">Title</label>
            <input name="title" type="text" id="title" value="{{ old('title') }}">
            <label for="description">Description</label>
            <textarea name="description" value="{{ old('description') }}" id="description" type="text"></textarea>
            <label for="assigned_to">Assign User</label>
            <select id="assigned_to" name="assigned_to">
                <option value="">No Assign Yet</option>
                @forelse ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @empty
                <p>There's no users to assign</p>
                @endforelse
            </select>   
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="pending">Pending</option>
                <option value="in_process">In Process</option>
                <option value="resolved">Resolved</option>
            </select>
            <label for="priority">Priority</label>
            <select id="priority" name="priority">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>  
        <button value="create" id="button">Create</button>
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