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
                <div class="form-element">
                    <label class="control-label d-block">Descrizione</label>
                    <textarea class="w-100" rows="10" type="text" name="description" placeholder="Inserisci la descrizione"></textarea>
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="number" class="form-control" placeholder="Metratura stanza" id="square_feet" name="square_feet">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="number" class="form-control" placeholder="Numero bagni" id="bathroom" name="bathroom">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="number" class="form-control" placeholder="Numero stanze" id="room" name="room">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="text" class="form-control" placeholder="Indirizzo" id="address" name="address">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <input type="file" name="image" id="image" class="form-control
                    @error('image')is-invalid @enderror">
                    @error('image')
                    <div class="text-danger">
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="number" class="form-control" placeholder="Latitudine" id="latitude" name="latitude">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="number" class="form-control" placeholder="Longitudine" id="longitude" name="longitude">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="number" class="form-control" placeholder="Prezzo" id="price" name="price">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Tipo</label>
                    <select class="form-control" name="free_cancellation" id="free_cancellation">
                        <option value="1">si</option>
                        <option value="0">no</option>
                    </select>
                </div>
                
                {{-- <div class="form-group my-3">
                    <label class="control-label">Tecnologie</label>
                    @foreach ($technologies as $technology)
                        <div>
                            <input type="checkbox" value="{{ $technology->id }}" name="technologies[]">
                            <label class="form-check-label">{{ $technology->name }}</label>
                        </div>
                    @endforeach
                </div> --}}
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-sm btn-success">Salva progetto</button>
                </div>
            </form>
        </div>
    </div>
@endsection