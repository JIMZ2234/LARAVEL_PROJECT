@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="card">
        <h2>✏️ Edit Task</h2>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:1.1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Task Name</label>
            <input type="text" name="task_name" value="{{ old('task_name', $task->task_name) }}" required>

            <label>Description</label>
            <textarea name="description" rows="3">{{ old('description', $task->description) }}</textarea>

            <label>Status</label>
            <select name="status">
                <option value="Pending" @selected($task->status === 'Pending')>Pending</option>
                <option value="Completed" @selected($task->status === 'Completed')>Completed</option>
            </select>

            <label>Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}">

            <div style="display:flex; gap:10px; margin-top: 0.5rem;">
                <button type="submit" class="btn btn-success">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-primary" style="background:#6b7280;">Cancel</a>
            </div>
        </form>
    </div>
@endsection