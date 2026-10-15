<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Ticket')}} - {{$ticket->id}}
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 overflow-hidden rounded-lg">
    <table class="table-auto md:table-fixed border-collapse border-gray-400 w-full shadow-xl">
        <thead>
            <tr class="bg-[#333333] text-white">
                <td class="border border-gray-400 p-4 rounded-tl-xl">Title</td>
                <td class="border border-gray-400 p-4">Description</td>
                <td class="border border-gray-400 p-4">Created By</td>
                <td class="border border-gray-400 p-4">Assigned To</td>
                <td class="border border-gray-400 p-4">Status</td>
                <td class="border border-gray-400 p-4">Priority</td>
                <td class="border border-gray-400 p-4">Created At</td>
                <td class="border border-gray-400 p-4 rounded-tr-xl">Actions</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-400 p-4">{{$ticket->title}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->description}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->createdBy->name ?? 'Anonimous'}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->assignedTo->name ?? 'Not assigned yet'}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->status}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->priority}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->created_at}}</td>
                <td class="border border-gray-400 p-4">
                    <div class="flex gap-2 items-center">
                        @if (auth()->user()->isAdmin())
                        <form method="POST" action="{{ route('ticket.destroy', $ticket->id) }}" onsubmit = "return confirm('Are you sure you want to delete this ticket?')">
                            @csrf
                            @method('DELETE')
                            <button value="delete" class="bg-red-500 hover:bg-red-400 p-2.5 rounded-xl transition duration-300">Delete</button>
                        </form>
                        @endif
                        <a href="{{ route('ticket.edit', $ticket->id) }}" class="bg-blue-400 hover:bg-blue-300 p-3 rounded-xl transition duration-300">Edit</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    @if (session('error'))
    <p style="color: red">{{ session('error') }}</p>
    @endif
</div>
</x-app-layout>