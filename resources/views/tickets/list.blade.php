@extends('layouts.dashboard')

@section('content')
<h1>Tickets</h1>
<table>
    <thead>
        Tickets List
    </thead>
    <tr>
        <td>Title</td>
        <td>Description</td>
        <td>Created By</td>
        <td>Assigned To</td>
        <td>Created At</td>
        <td>Actions</td>
    </tr>
    @forelse ($tickets as $ticket)
    <tr>
        <td>$ticket->title</td>
        <td>$ticket->description</td>
        <td>$ticket->created_by</td>
        <td>$ticket->assigned_to</td>
        <td>$ticket->created_at</td>
        <td>Details (Ruta)</td>
    </tr>
    @empty
    <p>There are not tickets.</p>
    @endforelse
</table>
@endsection