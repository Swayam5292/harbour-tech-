@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Project Showcase</h2>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Add New Project</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="card-header">
                <tr>
                    <th>Title</th>
                    <th>Tech Stack</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->tech_stack }}</td>
                    <td>
                        @if($project->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Archived</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-info">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No projects found. Add your first project!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
