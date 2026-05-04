@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Add New Project</div>
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

                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Project Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tech_stack" class="form-label">Tech Stack (comma separated)</label>
                        <input type="text" class="form-control @error('tech_stack') is-invalid @enderror" id="tech_stack" name="tech_stack" value="{{ old('tech_stack') }}" placeholder="e.g. Laravel, Vue, Bootstrap">
                        @error('tech_stack')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="github_url" class="form-label">GitHub URL (Optional)</label>
                            <input type="url" class="form-control @error('github_url') is-invalid @enderror" id="github_url" name="github_url" value="{{ old('github_url') }}">
                            @error('github_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="live_url" class="form-label">Live URL (Optional)</label>
                            <input type="url" class="form-control @error('live_url') is-invalid @enderror" id="live_url" name="live_url" value="{{ old('live_url') }}">
                            @error('live_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail_url" class="form-label">Thumbnail Image URL (Optional)</label>
                        <input type="url" class="form-control @error('thumbnail_url') is-invalid @enderror" id="thumbnail_url" name="thumbnail_url" value="{{ old('thumbnail_url') }}" placeholder="https://example.com/image.png">
                        @error('thumbnail_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active (Show on website)</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived (Hide from website)</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
