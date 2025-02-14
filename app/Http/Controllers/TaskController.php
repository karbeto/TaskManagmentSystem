<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $tasks = $query->get();
        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function create(Request $request)
    {
        $project_id = $request->get('project_id');
        $categories = Category::all();  
        return view('tasks.create', compact('project_id', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()->route('projects.index')->with('success', 'Task created successfully');
    }

    public function markCompleted($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'Task not found');
        }

        $task->status = 'completed';
        $task->save();

        return redirect()->route('projects.show', $task->project_id)->with('success', 'Task marked as completed.');
    }
}
