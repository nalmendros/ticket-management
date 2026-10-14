<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();

        return view('tickets.list', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|text',
        ]);

        $ticket = Ticket::create([
            'created_by' => $user,
            'assigned_to' => $request->input('assigned_to'),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->input('status'),
            'priority' => $request->input('priority'),
            'created_at' => now(),
        ]);

        $ticket->save();

        return redirect()->route('ticket.create')->with('success');

    }
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->status = $request->status;
        $ticket->priority = $request->priority;
        $ticket->save();
        return redirect()->route('ticket.update')->with('success');
    }
}
