<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket Control') }}
        </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    {{-------------------------- FILTERS -----------------}}

    <form method="GET" action="{{ route('ticket.control')}}" class="flex mb-3 gap-3">
        @csrf
        <div>
            <select id="searchUser" name="searchUser" class="rounded-xl">
                <option value="">All Users</option>
                <option value="null">Not assigned yet</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ request('searchUser') == $user->id ? 'selected' : ''}} >{{ $user->name }}</option>
                @endforeach
            </select>   
        </div>
        <div>
            @php 
                $statuses = ['Pending', 'In Process', 'Resolved'];
                $priorities = ['Low', 'Medium', 'High'];
            @endphp

            <select id="searchStatus" name="searchStatus" class="rounded-xl">
                <option value="">All Statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ request('searchStatus') == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
        </select>
        </div>
        <div>
            <select id="searchPriority" name="searchPriority" class="rounded-xl">
            <option value="">All Priorities</option>
            @foreach ($priorities as $priority)
                <option value="{{ $priority }}" {{ request('searchPriority') == $priority ? 'selected' : ''}} >{{ $priority }}</option>
            @endforeach
        </select>
        </div>
        <button value="Search">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
        <a href="{{ route('ticket.control') }}" class="bg-blue-400 p-3 rounded-xl hover:bg-[#333333] hover:text-white transition duration-300">
            Clear
        </a>
    </form>

    {{-------------------------- TICKET LIST --------------------------}}


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
                <td class="border border-gray-400 p-4"><a href="{{ route('ticket.show', $ticket->id )}}" class="cursor-pointer bg-blue-400 p-3 rounded-xl hover:bg-[#333333] hover:text-white transition duration-300">Details</a></td>
            </tr>
        </tbody>
        @empty
        <p>There are not tickets.</p>
        @endforelse
    </table>
</div>
</x-app-layout>
