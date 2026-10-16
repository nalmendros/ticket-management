<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit Ticket') }}
    </h2>
</x-slot>
<div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    
    <form method = "POST" action="{{ route('ticket.update', $ticket->id) }}" class="flex flex-col gap-3">
        @csrf
        @METHOD('PUT')
        <label for="title">Title</label>
        <input name="title" type="text" id="title" value="{{ $ticket->title }}" class="rounded-xl">
        <label for="description">Description</label>
        <textarea name="description" value="{{ $ticket->description }}" id="description" type="text" class="rounded-xl">{{ $ticket->description }}</textarea>
        @if (auth()->user()->isAdmin())
            <label for="assigned_to">Assign User</label>
            <select id="assigned_to" name="assigned_to" class="rounded-xl">
                <option value="">No Assign Yet</option>
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
            <select id="status" name="status" class="rounded-xl">
                <option value="{{ $ticket->status }}" selected>{{ $ticket->status }}</option>
                <option value="pending">Pending</option>
                <option value="in_process">In Process</option>
                <option value="resolved">Resolved</option>
            </select>
            <label for="priority">Priority</label>
            <select id="priority" name="priority" class="rounded-xl">
                <option value="{{ $ticket->priority }}" selected>{{ $ticket->priority }}</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        @endif
        <button value="create" id="button" class="cursor-pointer bg-[#06ba77] p-3 rounded-xl hover:bg-[#333333] hover:text-white transition duration-300">Confirm Edit</button>
    </form>
    
    
    @if ($errors->any())
        @foreach ($errors->all() as $error )
            <li class="text-red-500">{{ $error }}</li>
        @endforeach
    @endif
</div>
</x-app-layout>