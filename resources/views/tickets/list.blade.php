<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket List') }}
        </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="p-3 items-center w-[50px] mb-5 rounded-xl bg-blue-400 hover:bg-[#333333] hover:text-white transition duration-300">
        <a href="{{ route('ticket.create')}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </a>
    </div>
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="border-collapse border-gray-400 w-full">
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
                    <td class="border border-gray-400 p-4"><a href="{{ route('ticket.show', $ticket->id )}}" class="cursor-pointer bg-blue-400 p-3 rounded-xl hover:bg-[#333333] hover:text-white transition duration-300">Details</a></td>
                </tr>
            </tbody>
            @empty
            <p>There are not tickets.</p>
            @endforelse
        </table>
    </div>
</div>
</x-app-layout>
