@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="col-12">
            <h2 class="py-3">Aggiungi nuovo progetto</h2>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-12 py-3">
            <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="text" class="form-control" placeholder="Title" id="title" name="title">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <input type="file" name="cover_image" id="cover_image" class="form-control
                    @error('cover_image')is-invalid @enderror">
                    @error('cover_image')
                    <div class="text-danger">
                    @enderror
                </div>
                {{-- <div class="form-group my-3">
                    <label class="control-label">Tipo</label>
                    <select class="form-control" name="type_id" id="type_id">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group my-3">
                    <label class="control-label">Tecnologie</label>
                    @foreach ($technologies as $technology)
                        <div>
                            <input type="checkbox" value="{{ $technology->id }}" name="technologies[]">
                            <label class="form-check-label">{{ $technology->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Contenuto</label>
                    <textarea type="text" class="form-control" placeholder="Contenuto" id="content" name="content"></textarea>
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-sm btn-success">Salva progetto</button>
                </div>
            </form>
        </div>
    </div>
@endsection