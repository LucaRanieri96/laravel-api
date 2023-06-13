@extends('layouts.admin')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('admin.projects.create') }}" role="button">New Project</a>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif

    <div class="table-responsive rounded mb-3">
        <table class="table table-striped">
            <thead>
                <tr class="align-middle">
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Repository URL</th>
                    <th scope="col">Starting date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr class="align-middle">
                        <td scope="row">{{ $project->id }}</td>
                        <td scope="row">
                            <img height="100" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{$project->title}}">
                        </td>
                        <td scope="row">{{ $project->name }}</td>
                        <td scope="row">{{ $project->repoUrl }}</td>
                        <td scope="row">{{ $project->startingDate }}</td>
                        <td scope="row"><span class="badge bg-primary"> {{ $project->type?->name }}</span></td>
                        <td scope="row">
                            <a class="btn btn-success" href="{{ route('admin.projects.show', $project->slug) }}">
                                <i class="fa-regular fa-eye fa-fw"></i>
                            </a>
                            <a class="btn btn-info my-1" href="{{ route('admin.projects.edit', $project->slug) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $project->id }}">
                                <i class="fa-regular fa-trash-can fa-fw"></i>
                            </button>
                            <!-- Modal -->
                        </td>
                    </tr>
                    <div class="modal fade" id="modal-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $project->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="modalTitle-{{ $project->id }}">Attenzione!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-black">
                                    Sicuro di voler cancellare la repo?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                @empty
                    <tr>
                        <td scope="row">No projects found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
