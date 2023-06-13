@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-light my-4">
            Dashboard
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-3">
                    <div class="p-3 rounded-3 text-center {{ str_starts_with(Route::currentRouteName(), 'admin.projects') ? 'bg-primary' : '' }} border border-light">
                        <a class="fw-bold text-decoration-none text-white" href="{{ route('admin.projects.index') }}">Projects</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="p-3 rounded-3 text-center {{ str_starts_with(Route::currentRouteName(), 'admin.technologies') ? 'bg-primary' : '' }} border border-light">
                        <a class="fw-bold text-decoration-none text-white" href="{{ route('admin.technologies.index') }}">Technologies</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="p-3 rounded-3 text-center {{ str_starts_with(Route::currentRouteName(), 'admin.types') ? 'bg-primary' : '' }} border border-light">
                        <a class="fw-bold text-decoration-none text-white" href="{{ route('admin.types.index') }}">Types</a>
                    </div>
                </div>
            </div>
        </div>

       
        
    </div>
@endsection
