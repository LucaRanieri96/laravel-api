@extends('layouts.admin')

@section('content')
<a class="btn btn-primary mb-3" href="" role="button">New Technology</a>

@if(session("message"))
<div class="alert alert-success" role="alert">
  <strong>{{ session("message") }}</strong>
</div>
@endif

<div class="table-responsive rounded bg-black mb-3">
  <table class="table table-striped align-middle text-center mb-0">
    <thead>
      <tr class="align-middle">
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Projects</th>
      </tr>
    </thead>
    <tbody>
      @forelse($technologies as $technology)
      <tr>
        <td scope="row" class="">{{ $technology->id }}</td>
        <td scope="row" class=""><span class="badge bg-danger">{{ $technology->name }}</span></td>
        <th scope="row" class="text-success">{{count($technology->projects)}}</th>
      </tr>
      @empty
      <tr>
        <td class="text_custom_green" scope="row">No technology found</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="mt-2">
  <a class="btn btn-outline-light" href="{{ route('admin.projects.index') }}" role="button">Back</a>
</div>
@endsection