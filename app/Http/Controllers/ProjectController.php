<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();
    
        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->input('due_date'));
        }
    
        $projects = $query->get();
    
        return view('projects.index', compact('projects'));
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $project = Project::create($validated);
        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function edit(string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found');
        }

        return view('projects.edit', compact('project'));
    }


    public function show($id)
    {
        $project = Project::findOrFail($id);
        $tasksQuery = $project->tasks();
    
        // Apply filters based on the request
        if ($status = request('status')) {
            $tasksQuery->where('status', $status);
        }
    
        if ($categoryId = request('category_id')) {
            $tasksQuery->where('category_id', $categoryId);
        }
    
        $tasks = $tasksQuery->get();
    
        $categories = Category::all(); 
    
        return view('projects.show', compact('project', 'tasks', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $project->update($validated);
        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    public function destroy(string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found');
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}
