@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-5">Create Category</h1>

    <form action="{{ route('categories.store') }}" method="POST" class="w-full max-w-lg">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter category name">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 focus:outline-none">Create</button>
        </div>
    </form>
@endsection
