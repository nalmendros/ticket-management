<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Ticket Create')}}
    </h2>
</x-slot>
<div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <form method = "POST" action="{{ route('ticket.store') }}" class="flex flex-col gap-3">
        @csrf
            <label for="title">Title</label>
            <input name="title" type="text" id="title" value="{{ old('title') }}" class="rounded-xl">
            <label for="description">Description</label>
            <textarea name="description" value="{{ old('description') }}" id="description" type="text" class="rounded-xl"></textarea>
            @if (auth()->user()->isAdmin())
            <label for="assigned_to">Assign User</label>
            <select id="assigned_to" name="assigned_to" class="rounded-xl">
                <option value="">No Assigned Yet</option>
                @forelse ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @empty
                <p>There's no users to assign</p>
                @endforelse
            </select>   
            @endif
            <label for="status">Status</label>
            <select id="status" name="status" class="rounded-xl">
                @foreach(App\Models\Ticket::STATUSES as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
            <label for="priority">Priority</label>
            <select id="priority" name="priority" class="rounded-xl">
                @foreach(App\Models\Ticket::PRIORITIES as $priority)
                    <option value="{{ $priority }}">{{ $priority }}</option>
                @endforeach
            </select>  
        <button value="create" id="button" class="cursor-pointer bg-[#06ba77] p-3 rounded-xl hover:bg-[#333333] hover:text-white transition duration-300">Create</button>
        
        @if (session('success'))
            <x-message type='success' :message="session('success')" />
        @endif
    </form>
    @if ($errors->any())
        @foreach ($errors->all() as $error )
            <li class="text-red-500">{{ $error }}</li>
        @endforeach
    @endif
</div>

</x-app-layout>