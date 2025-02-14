@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-5">Categories</h1>

@if(session('success'))
<div class="bg-green-500 text-white p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">
    Create Category
</a>

@if($categories->isEmpty())
<p class="text-gray-500">No projects currently available.</p>
@else

<table class="min-w-full table-auto border-collapse mt-3">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 text-left text-gray-700">Name</th>
            <th class="px-4 py-2 text-left text-gray-700">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr class="border-b hover:bg-gray-100">
            <td class="px-4 py-2">{{ $category->name }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:underline">Edit</a>

                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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
@endsection