<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'thumbnail_url' => 'nullable|url',
            'status' => 'required|in:active,archived',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'thumbnail_url' => 'nullable|url',
            'status' => 'required|in:active,archived',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    // --- API Endpoints for Main Website ---
    public function apiIndex(Request $request)
    {
        $sort = $request->query('sort', 'likes');
        
        $query = Project::where('status', 'active');
        
        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            // Default to likes
            $query->orderBy('likes', 'desc')->orderBy('created_at', 'desc');
        }

        return response()->json($query->get());
    }

    public function apiLike(Project $project)
    {
        $project->increment('likes');
        return response()->json(['success' => true, 'likes' => $project->likes]);
    }
}
