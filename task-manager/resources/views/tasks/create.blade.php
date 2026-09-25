@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    <div class="card">
        <h2>➕ Add New Task</h2>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:1.1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <label>Task Name</label>
            <input type="text" name="task_name" value="{{ old('task_name') }}" placeholder="e.g. Finish project report" required>

            <label>Description</label>
            <textarea name="description" rows="3" placeholder="Optional details...">{{ old('description') }}</textarea>

            <label>Status</label>
            <select name="status">
                <option value="Pending" selected>Pending</option>
                <option value="Completed">Completed</option>
            </select>

            <label>Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}">

            <div style="display:flex; gap:10px; margin-top: 0.5rem;">
                <button type="submit" class="btn btn-success">Save Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-primary" style="background:#6b7280;">Cancel</a>
            </div>
        </form>
    </div>
@endsection