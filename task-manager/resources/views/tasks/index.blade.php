@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
    @php
        $total = $tasks->count();
        $pending = $tasks->where('status', 'Pending')->count();
        $completed = $tasks->where('status', 'Completed')->count();
    @endphp

    <div class="stats">
        <div class="stat-card">
            <h3>{{ $total }}</h3>
            <p>Total Tasks</p>
        </div>
        <div class="stat-card pending">
            <h3>{{ $pending }}</h3>
            <p>Pending</p>
        </div>
        <div class="stat-card completed">
            <h3>{{ $completed }}</h3>
            <p>Completed</p>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h2>Your Tasks</h2>
            <a href="{{ route('tasks.create') }}" class="btn btn-add">+ Add New Task</a>
        </div>

        @if ($tasks->isEmpty())
            <div class="empty-state">
                <p>You don't have any tasks yet.</p>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create your first task</a>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td data-label="Task">
                                <div class="task-name">{{ $task->task_name }}</div>
                                @if ($task->description)
                                    <div class="task-desc">{{ \Illuminate\Support\Str::limit($task->description, 60) }}</div>
                                @endif
                            </td>
                            <td data-label="Status">
                                <span class="badge {{ $task->status === 'Completed' ? 'badge-completed' : 'badge-pending' }}">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td data-label="Due Date">
                                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : '—' }}
                            </td>
                            <td data-label="Actions">
                                <div class="actions">
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Edit</a>

                                    <form action="{{ route('tasks.status', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning">
                                            {{ $task->status === 'Pending' ? 'Mark Done' : 'Mark Pending' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection