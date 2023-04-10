@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="col-12">
            <h2 class="py-3">Modifica appartamento</h2>
        </div>
        <div class="col-12 py-3">
            <form action="{{ route('admin.apartments.update', $apartment->slug) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="text" class="form-control" placeholder="Title" id="title" name="title" value="{{ old('title') ?? $apartment->title }}">
                    @if ($errors->has('title'))
                    <div class="text-danger">{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="form-element">
                    <label class="control-label d-block">Descrizione</label>
                    <textarea class="w-100" rows="10" type="text" name="description" placeholder="Inserisci la descrizione">{{ old('description') ?? $apartment->description }}</textarea>
                    @if ($errors->has('description'))
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Metri quadri</label>
                    <input type="number" class="form-control" placeholder="Metratura stanza" id="square_feet" name="square_feet" value="{{ old('square_feet') ?? $apartment->square_feet }}">
                    @if ($errors->has('square_feet'))
                    <div class="text-danger">{{ $errors->first('square_feet') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Bagni</label>
                    <input type="number" class="form-control" placeholder="Numero bagni" id="bathroom" name="bathroom" value="{{ old('bathroom') ?? $apartment->bathroom }}">
                    @if ($errors->has('bathroom'))
                    <div class="text-danger">{{ $errors->first('bathroom') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Stanze</label>
                    <input type="number" class="form-control" placeholder="Numero stanze" id="room" name="room" value="{{ old('room') ?? $apartment->room }}">
                    @if ($errors->has('room'))
                    <div class="text-danger">{{ $errors->first('room') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Posti letto</label>
                    <input type="number" class="form-control" placeholder="Numero posti letto" id="bed" name="bed" value="{{ old('bed') ?? $apartment->bed }}">
                    @if ($errors->has('room'))
                    <div class="text-danger">{{ $errors->first('room') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Indirizzo</label>
                    <input type="text" class="form-control" placeholder="Indirizzo" id="address" name="address" value="{{ old('address') ?? $apartment->address }}">
                    @if ($errors->has('address'))
                    <div class="text-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <div>
                        @if (Str::contains($apartment->image, 'post_images'))
                        <img src="{{asset('storage/' .$apartment->image)}}" alt="">
                        @else
                        <img class="card-img-top my_cardimg rounded" src="{{ $apartment->image }}" alt="">
                        @endif                    </div>
                    <input type="file" name="image" id="image"
                        class="form-control
                    @error('image')is-invalid @enderror">
                    @error('image')
                        <div class="text-danger">
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Latitudine</label>
                        <input type="number" class="form-control" placeholder="Latitudine" id="latitude" name="latitude" value="{{ old('latitude') ?? $apartment->latitude }}">
                        @if ($errors->has('latitude'))
                    <div class="text-danger">{{ $errors->first('latitude') }}</div>
                    @endif
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Longitudine</label>
                        <input type="number" class="form-control" placeholder="Longitudine" id="longitude" name="longitude" value="{{ old('longitude') ?? $apartment->longitude }}">
                        @if ($errors->has('longitude'))
                    <div class="text-danger">{{ $errors->first('longitude') }}</div>
                    @endif
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Servizi</label>
                        @foreach ($services as $service)
                            <div>
                                @if ($errors->any())
                                    <input type="checkbox" value="{{ $service->id }}" name="services[]" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $service->name }}</label>
                                @else
                                    <input type="checkbox" value="{{ $service->id }}" name="services[]" {{ $apartment->services->contains($service) ? 'checked' : ''  }}>
                                    <label class="form-check-label">{{ $service->name }}</label>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-sm btn-success">Salva progetto</button>
                    </div>
            </form>
        </div>
    </div>
@endsection