@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif

    <div class="card overflow-hidden">
        <div class="card-header">
            <h2 class="mb-0">{{ $project->slug }}</h2>
        </div>
        <div class="card-body bg-dark text-light">
            <h4>Project name:
                <br>
                <span class="fw-normal">{{ $project->name }}</span>
            </h4>
            <hr>
            <h4>Project image:
                <br>
                <span>
                    <img height="100" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}">
                </span>
            </h4>
            <hr>
            <h4>Repository URL:
                <br>
                <span class="fw-normal">{{ $project->repoUrl }}</span>
            </h4>
            <hr>
            <h4>Type:
                <span class="badge bg-primary">{{ $project->type?->name }}</span>
            </h4>
            <hr>
            @if ($project->technologies->count() > 0)
                <h4>Technologies:</h4>
                <ul>
                    @foreach ($project->technologies as $technology)
                        <li><span class="badge bg-danger">{{ $technology->name }}</span></li>
                    @endforeach
                </ul>
            @else
                <p>No technologies associated with this project.</p>
            @endif
            <h4>Project starting date:
                <br>
                <span class="fw-normal">{{ $project->startingDate }}</span>
            </h4>
        </div>
    </div>

    <div class="mt-2">
        <a class="btn btn-outline-light" href="{{ route('admin.projects.index') }}" role="button">Back</a>
    </div>
@endsection
