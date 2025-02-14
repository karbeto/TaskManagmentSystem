@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Projects</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="mb-4 flex items-center space-x-4">
            <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create New Project</a>

            <!-- Filter by Due Date -->
            <form method="GET" action="{{ route('projects.index') }}" class="flex items-center">
                <label for="due_date" class="mr-2">Filter by Due Date:</label>
                <input type="date" name="due_date" id="due_date" class="border p-2 rounded" value="{{ request('due_date') }}">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
            </form>
        </div>

        @if($projects->isEmpty())
            <p class="text-gray-500">No projects currently available.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-md">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Project Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Due Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $project->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $project->description }}</td>
                            <td class="px-6 py-4 border-b">{{ $project->due_date }}</td>
                            <td class="px-6 py-4 border-b">
                                <a href="{{ route('projects.show', $project->id) }}" class="text-blue-500 hover:underline">View</a>
                                <a href="{{ route('projects.edit', $project->id) }}" class="text-yellow-500 hover:underline ml-4">Edit</a>
                                <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="text-green-500 hover:underline ml-4">Add Tasks</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
