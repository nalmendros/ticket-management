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
        $user = Auth::id();
        $tickets = Ticket::where('assigned_to', $user)
        ->orWhere('created_by', $user)
        ->get();

        return view('tickets.list', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.details', compact('ticket'));
    }

    public function create()
    {
        $users = User::all();
        return view('tickets.create', compact('users'));
    }

    public function store(Request $request)
    {
        $user = Auth::User();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,in_process,resolved',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket = Ticket::create([
            'created_by' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->input('assigned_to'),
            'status' => $request->status,
            'priority' => $request->priority,
        ]);
        
        return redirect()->route('ticket.create')->with('success', 'Ticket created successfully.');

    }

    public function edit(Ticket $ticket)
    {
        $users = User::all();
        return view('tickets.edit', compact('ticket', 'users'));
    }
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->assigned_to = $request->assigned_to;
        $ticket->status = $request->status;
        $ticket->priority = $request->priority;
        $ticket->save();
        return redirect()->route('ticket.show', $ticket->id)->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        if ($ticket->assignedTo) {
            return redirect()->route('ticket.show', $ticket->id)->with('error', 'This ticket is assigned');
        } else {
            $ticket->delete();
        }
        return redirect()->route('ticket.index')->with('success');
    }

    public function ticketControl(Request $request)
    {
        $query = Ticket::query();

        if ($request->searchStatus) {
            $query->where('status', $request->searchStatus);
        }
        if ($request->searchPriority) {
            $query->where('priority', $request->searchPriority);
        }
        if ($request->searchUser) {
            $query->where('created_by', $request->searchUser);
        }
        
        if (!auth()->check() | !auth()->user()->isAdmin()) {
            abort(403);
        } 
        $users = User::all();
        $tickets = $query->get();

        return view('tickets.control', compact('tickets', 'users'));
    }

}
