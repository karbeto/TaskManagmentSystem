@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Add Task to Project</h1>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project_id }}">

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
                <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-md" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="w-full border-gray-300 rounded-md"></textarea>
            </div>

            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Task</button>
            </div>
        </form>
    </div>
@endsection
