@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $project->name }}</h1>
    <p class="text-lg text-gray-700"><strong>Description:</strong> {{ $project->description }}</p>
    <p class="text-lg text-gray-700"><strong>Due Date:</strong> {{ $project->due_date }}</p>

    <h2 class="text-2xl font-semibold mt-6">Tasks</h2>

    <form method="GET" action="{{ route('projects.show', $project->id) }}" class="mb-4 flex items-center space-x-4">
        <select name="category_id" class="border p-2 rounded">
            <option value="">Select Category</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>

        <select name="status" class="border p-2 rounded">
            <option value="">Select Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
    </form>

    @if($tasks->isEmpty())
    <p class="text-gray-500">No tasks available for this project.</p>
    @else
    <ul class="list-disc pl-6">
        @foreach($tasks as $task)
        <li class="text-lg text-gray-700">
            <strong>{{ $task->title }}</strong> - {{ ucfirst($task->status) }} (Due: {{ $task->due_date }})
            <p>{{ $task->description }}</p>

            @if($task->status != 'completed')
            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="text-green-500 hover:underline ml-2">Mark as Completed</button>
            </form>
            @endif
        </li>
        @endforeach
    </ul>
    @endif

    <a href="{{ route('projects.index') }}" class="text-blue-500 hover:underline mt-4 inline-block">Back to Projects</a>
</div>
@endsection