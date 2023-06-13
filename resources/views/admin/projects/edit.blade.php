@extends("layouts.admin")

@section("content")

@if($errors->any())

@foreach($errors->all() as $error)
<div class="alert alert-danger" role="alert">
  <strong>{{$error}}</strong>
</div>
@endforeach

@endif

<form action="{{ route('admin.projects.update', $project->slug) }}" method="post" enctype="multipart/form-data">

  @csrf
  @method("PUT")

  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $project->name)}}">
    <small id="titleHelper" class="text-muted">Type the new name</small>

    @error('name')
    <small class="text-danger">Please, fill the field correctly</small>
    @enderror
    
  </div>

  <div class="mb-3">
    <label for="type_id" class="form-label">Types</label>
    <select class="form-select" name="type_id" id="type_id">
      <option value="">Select a type</option>
      @foreach ($types as $type)
      <option value="{{ $type?->id }}" {{ $type?->id == old('type_id', $project->type?->id) ? 'selected' : ''}}>{{ $type?->name }}</option>
      @endforeach
    </select>

  </div>

  <div class="form_group mb-3">
    <p>Technology selection:</p>
    @foreach ($technologies as $technology)
      <div class="form-check" @error('technologies') is-invalid @enderror>

        @if($errors->any())
  
        <input name="technologies[]" type="checkbox" value="{{ $technology->id }}" class="form-check-input" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
  
        @else 
  
        <input name="technologies[]" type="checkbox" value="{{ $technology->id }}" class="form-check-input" {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
        
        @endif

        <label class="form-check-label">{{ $technology->name }}</label>
      </div>


    @endforeach

    @error('technologies')
    <div class="invalid-feedback">
      {{message}}
    </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="type_id" class="form-label">Starting Date</label>
    <input type="date" name="startingDate" id="startingDate" class="form-control @error('startingDate') is-invalid @enderror" value="{{ old('startingDate') }}" placeholder="Project startingDate">
    
    @error('startingDate')
    <small class="text-danger">Please, fill the field correctly</small>
    @enderror

  </div>

  <div class="mb-3">
    <img width="100px" class="mb-1" src="{{ asset('storage/' . $project->cover_image)}}" alt="">

    <label for="cover_image" class="form-label">Replace image</label>
    <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" placeholder="Project cover_image">
    
    @error('cover_image')
    <small class="text-danger">Please, fill the field correctly</small>
    @enderror

  </div>

  <a class="btn btn-outline-light" href="{{ route('admin.projects.index') }}" role="button">Back</a>
  <button type="submit" class="btn btn-primary">Edit project</button>
  <button type="reset" class="btn btn-danger">Reset fields</button>
</form>

@endsection