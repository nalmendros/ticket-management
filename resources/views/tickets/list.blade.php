<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket List') }}
        </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <table class="table-auto md:table-fixed border-collapse border-gray-400 w-full">
        <thead>
            <tr class="bg-[#333333] text-white">
                <td class="border border-gray-400 p-4">Title</td>
                <td class="border border-gray-400 p-4">Description</td>
                <td class="border border-gray-400 p-4">Created By</td>
                <td class="border border-gray-400 p-4">Assigned To</td>
                <td class="border border-gray-400 p-4">Status</td>
                <td class="border border-gray-400 p-4">Priority</td>
                <td class="border border-gray-400 p-4">Created At</td>
                <td class="border border-gray-400 p-4">Actions</td>
            </tr>
        </thead>
        @forelse ($tickets as $ticket)
        <tbody>
            <tr>
                <td class="border border-gray-400 p-4">{{$ticket->title}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->description}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->createdBy->name ?? 'Anonimous'}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->assignedTo->name ?? 'Not assigned yet'}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->status}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->priority}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->created_at}}</td>
                <td class="border border-gray-400 p-4"><a href="{{ route('ticket.show', $ticket->id )}}" class="cursor-pointer bg-[#06ba77] p-3 rounded-xl hover:bg-[#333333] hover:text-white">Details</a></td>
            </tr>
        </tbody>
        @empty
        <p>There are not tickets.</p>
        @endforelse
    </table>
</div>
</x-app-layout>
