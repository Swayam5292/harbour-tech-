@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Project: {{ $project->title }}</div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('projects.update', $project) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Project Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tech_stack" class="form-label">Tech Stack (comma separated)</label>
                        <input type="text" class="form-control" id="tech_stack" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="github_url" class="form-label">GitHub URL (Optional)</label>
                            <input type="url" class="form-control" id="github_url" name="github_url" value="{{ old('github_url', $project->github_url) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="live_url" class="form-label">Live URL (Optional)</label>
                            <input type="url" class="form-control" id="live_url" name="live_url" value="{{ old('live_url', $project->live_url) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail_url" class="form-label">Thumbnail Image URL (Optional)</label>
                        <input type="url" class="form-control" id="thumbnail_url" name="thumbnail_url" value="{{ old('thumbnail_url', $project->thumbnail_url) }}">
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>Active (Show on website)</option>
                            <option value="archived" {{ old('status', $project->status) == 'archived' ? 'selected' : '' }}>Archived (Hide from website)</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
