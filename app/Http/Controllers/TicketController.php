<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{

    public function index()
    {
        $userId = Auth::id();
        $tickets = Ticket::where('created_by', $userId)
        ->get();

        return view('tickets.list', compact('tickets'));
    }

    public function show(Ticket $ticket, Request $request)
    {
        if ($request->user()->cannot('view', $ticket)) {
            return redirect()->back()
                ->with('error', 'You are not authorized to view this ticket.');
        }
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
            'status' => 'required|in:' . implode(',', Ticket::STATUSES), // Implode: Junta elementos del array en un string separado en comas
            'priority' => 'required|in:' . implode(',', Ticket::PRIORITIES),
        ]);

        $ticket = Ticket::create([
            'created_by' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->input('assigned_to'),
            'status' => $request->status,
            'priority' => $request->priority,
        ]);
        
        return redirect()->route('ticket.index')->with('success', 'Ticket created successfully.');

    }

    public function edit(Ticket $ticket, Request $request)
    {
        if ($request->user()->cannot('view', $ticket)) {
            return redirect()->back()
                ->with('error', 'You are not authorized to view this ticket.');
        }
        $users = User::all();
        return view('tickets.edit', compact('ticket', 'users'));
    }

    public function update(Request $request, $id)
    {
        
        $ticket = Ticket::findOrFail($id);

        if ($request->user()->cannot('update', $ticket)) {
            return redirect()->back()
                ->with('error', 'You are not authorized to update this ticket.');
        }

        $user = $request->user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        $ticket->title = $validated['title'];
        $ticket->description = $validated['description'];

        if ($user->isAdmin()) {
            $adminData = $request->validate([
                'assigned_to' => 'nullable|exists:users,id',
                'status' => 'required|in:' . implode(',', Ticket::STATUSES),
                'priority' => 'required|in:' . implode(',', Ticket::PRIORITIES),
            ]);
            $ticket->assigned_to = $adminData['assigned_to'];
            $ticket->status = $adminData['status'];
            $ticket->priority = $adminData['priority'];

            return redirect()->route('ticket.control', $ticket->id)->with('success', 'Ticket updated successfully.');
        }

        $ticket->save();
        
        return redirect()->route('ticket.index', $ticket->id)->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket, Request $request)
    {
        if ($request->user()->cannot('delete', $ticket)) {            
            return redirect()->back()->with('error', 'This ticket is assigned or it is not resolved.');
        } else {
            $ticket->delete();
            return redirect()->back()->with('success', 'Ticket deleted successfully.');
        }

    }

    public function ticketControl(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $users = $request->searchUser;
        $statuses = $request->searchStatus;
        $priorities = $request->searchPriority;

        $tickets = Ticket::query()
            ->byUsers($users)
            ->byStatuses($statuses)
            ->byPriorities($priorities)
            ->get();

        $users = User::all();

        return view('tickets.control', compact('tickets', 'users'));
    }

}
