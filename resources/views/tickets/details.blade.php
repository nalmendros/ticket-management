<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Ticket')}} - {{$ticket->id}}
    </h2>
</x-slot>
<div class="p-12">

    <table class="w-full border">
        <thead>
            <tr>
                <td>Title</td>
                <td>Description</td>
                <td>Created By</td>
                <td>Assigned To</td>
                <td>Status</td>
                <td>Priority</td>
                <td>Created At</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$ticket->title}}</td>
                <td>{{$ticket->description}}</td>
                <td>{{$ticket->createdBy->name ?? 'Anonimous'}}</td>
                <td>{{$ticket->assignedTo->name ?? 'Not assigned yet'}}</td>
                <td>{{$ticket->status}}</td>
                <td>{{$ticket->priority}}</td>
                <td>{{$ticket->created_at}}</td>
                <td>
                    <form method="POST" action="{{ route('ticket.destroy', $ticket->id) }}" onsubmit = "return confirm('Are you sure you want to delete this ticket?')">
                        @csrf
                        @method('DELETE')
                        <button value="delete" class="bg-[##ed0202] color-white p-4 rounded-xl">Delete</button>
                    </form>
                    <a href="{{ route('ticket.edit', $ticket->id) }}" style="color: blue">Edit</a>
                </td>
            </tr>
        </tbody>
    </table>
    @if (session('error'))
    <p style="color: red">{{ session('error') }}</p>
    @endif
</div>
</x-app-layout>