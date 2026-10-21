
<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Ticket')}} - {{$ticket->id}}
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="border-collapse border-gray-400 w-full shadow-xl">
        <thead>
            <tr class="bg-[#333333] text-white">
                <td class="border border-gray-400 p-4 rounded-tl-xl">Title</td>
                <td class="border border-gray-400 p-4">Description</td>
                <td class="border border-gray-400 p-4">Created By</td>
                <td class="border border-gray-400 p-4">Assigned To</td>
                <td class="border border-gray-400 p-4">Status</td>
                <td class="border border-gray-400 p-4">Priority</td>
                <td class="border border-gray-400 p-4">Created At</td>
                <td class="border border-gray-400 p-4">Acciones</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-400 p-4">{{$ticket->title}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->description}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->createdBy->name ?? 'Anonimous'}}</td>
                <td class="border border-gray-400 p-4">{{$ticket->assignedTo->name ?? 'Not assigned yet'}}</td>
                <td class="border border-gray-400 p-4">
                    <x-status-badge :status="$ticket->status" />
                </td>
                <td class="border border-gray-400 p-4">
                    <x-priority-badge :priority="$ticket->priority" />
                </td>
                <td class="border border-gray-400 p-4">{{$ticket->created_at}}</td>
                <td class="border border-gray-400 p-4">
                    <div class="flex">
                        <a href="{{ route('ticket.edit', $ticket->id) }}" class="hover:bg-blue-300 p-3 rounded-xl transition duration-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    @if (session('success'))
        <x-message type='success' :message="session('success')" />
    @endif
    @if (session('error'))
        <x-message type='error' :message="session('error')" />
    @endif
    
</div>
</x-app-layout>