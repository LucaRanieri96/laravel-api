@extends("layouts.admin")

@section("content")

@if($errors->any())

@foreach($errors->all() as $error)
<div class="alert alert-danger" role="alert">
  <strong>{{$error}}</strong>
</div>
@endforeach

@endif

<form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Project name">

    @error('name')
    <small class="text-danger">Please, fill the field correctly</small>
    @enderror
    
  </div>

  <div class="mb-3">
    <label for="type_id" class="form-label">Types</label>
    <select class="form-select @error('type') is-invalid @enderror" name="type_id" id="type_id">
      <option value="">Select a type</option>
      @foreach ($types as $type)
      <option value="{{ $type->id }}" {{ $type->id == old('type_id', '') ? 'selected' : ''}}>{{ $type->name }}</option>
      @endforeach
    </select>

    @error('type')
    <small class="text-danger">Please, fill the field correctly</small>
    @enderror

  </div>

  <div class="form_group mb-3">
    <p>Technology selection:</p>
    @foreach ($technologies as $technology)
      <div class="form-check @error('technologies') is-invalid @enderror">

        
        <label class="form-check-label">

          <input type="checkbox" name="technologies[]" value="{{$technology->id}}" class="form-check-input" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>

          {{ $technology->name }}
        </label>

      </div>
    @endforeach

    @error('technologies')
    <div class="invalid-feedback">
      ERRORE CON TECHNOLOGIES
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
    <label for="cover_image" class="form-label">Image</label>
    <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" placeholder="Project cover_image">
    
    @error('cover_image')
    <small class="text-danger">Please, fill the field correctly</small>
    @enderror

  </div>

  <a class="btn btn-outline-light" href="{{ route('admin.projects.index') }}" role="button">Back</a>
  <button type="submit" class="btn btn-primary">Insert project</button>
  <button type="reset" class="btn btn-danger">Reset fields</button>
</form>

@endsection
