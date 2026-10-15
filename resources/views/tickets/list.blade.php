<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket List') }}
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
        @forelse ($tickets as $ticket)
        <tbody>
    
            <tr>
                <td>{{$ticket->title}}</td>
                <td>{{$ticket->description}}</td>
                <td>{{$ticket->createdBy->name ?? 'Anonimous'}}</td>
                <td>{{$ticket->assignedTo->name ?? 'Not assigned yet'}}</td>
                <td>{{$ticket->status}}</td>
                <td>{{$ticket->priority}}</td>
                <td>{{$ticket->created_at}}</td>
                <td><a href="{{ route('ticket.show', $ticket->id )}}" class="cursor-pointer">Details</a></td>
            </tr>
        </tbody>
        @empty
        <p>There are not tickets.</p>
        @endforelse
    </table>
</div>
</x-app-layout>
