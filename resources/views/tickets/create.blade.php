@extends('layouts.dashboard')
@section('content')
<h1>Create Ticket</h1>
<form method = "POST" action="/tickets">
    <label for="title">Title</label>
    <input name="title">
    <label for="description">Description</label>
    <input name="description">
    <label for="status">Status</label>
    <select for="status">
        <option name="pending">Pending</option>
        <option name="in_process">In Process</option>
        <option name="resolved">Resolved</option>
    </select>
    <label for="priority">Priority</label>
    <select for="priority">
        <option name="low">Low</option>
        <option name="medium">Medium</option>
        <option name="high">High</option>
    </select>
    <button name="create">Create</button>
</form>
@endsection