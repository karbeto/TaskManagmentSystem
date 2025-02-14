@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Edit Project</h1>

        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
                <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded-md mt-1" value="{{ $project->name }}" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" class="w-full p-2 border border-gray-300 rounded-md mt-1">{{ $project->description }}</textarea>
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" class="w-full p-2 border border-gray-300 rounded-md mt-1" value="{{ $project->due_date }}">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Project</button>
        </form>

        <a href="{{ route('projects.index') }}" class="text-blue-500 hover:underline mt-4 inline-block">Back to Projects</a>
    </div>
@endsection
