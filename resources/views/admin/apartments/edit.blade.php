@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="col-12">
            <h2 class="py-3">modifica appartamento</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-12 py-3">
            <form action="{{ route('admin.apartments.update', $apartment->slug) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="text" class="form-control" placeholder="Title" id="title" name="title" value="{{ old('title') ?? $apartment->title }}" required>
                </div>
                <div class="form-element">
                    <label class="control-label d-block" for="validationTextarea">Descrizione</label>
                    <textarea class="w-100" rows="10" type="text" id="validationTextarea" name="description" placeholder="Inserisci la descrizione" required>{{ old('description') ?? $apartment->description }}</textarea>
                    <div class="valid-feedback">
                        descrizione sono validi!
                      </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Metri quadri</label>
                    <input type="number" class="form-control" placeholder="Metratura stanza" id="square_feet" name="square_feet" value="{{ old('square_feet') ?? $apartment->square_feet }}" required>
                    <div class="valid-feedback">
                        i metri quadri sono validi!
                      </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('square_feet') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Bagni</label>
                    <input type="number" class="form-control" placeholder="Numero bagni" id="bathroom" name="bathroom" value="{{ old('bathroom') ?? $apartment->bathroom }}" required>
                    <div class="valid-feedback">
                        i bagni sono validi!
                      </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('bathroom') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Stanze</label>
                    <input type="number" class="form-control" placeholder="Numero stanze" id="room" name="room" value="{{ old('room') ?? $apartment->room }}" required>
                    <div class="valid-feedback">
                        le stanze sono valide!
                      </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('room') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Indirizzo</label>
                    <input type="text" class="form-control" placeholder="Indirizzo" id="address" name="address" value="{{ old('address') ?? $apartment->address }}" required>
                    <div class="valid-feedback">
                        l'indirizzo è validi!
                      </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <div>
                        <img src="{{asset('storage/' .$apartment->image)}}" alt="">
                    </div>
                    <input type="file" name="image" id="image"
                        class="form-control
                    @error('image')is-invalid @enderror">
                    @error('image')
                        <div class="text-danger">
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Latitudine</label>
                        <input type="number" class="form-control" placeholder="Latitudine" id="latitude" name="latitude" value="{{ old('latitude') ?? $apartment->latitude }}" required>
                        <div class="valid-feedback">
                            latitudine valida!
                          </div>
                        @if ($errors->any())
                        <div class="text-danger">{{ $errors->first('latitude') }}</div>
                        @endif
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Longitudine</label>
                        <input type="number" class="form-control" placeholder="Longitudine" id="longitude" name="longitude" value="{{ old('longitude') ?? $apartment->longitude }}" required>
                        <div class="valid-feedback">
                            longitudine validi!
                          </div>
                        @if ($errors->any())
                        <div class="text-danger">{{ $errors->first('longitude') }}</div>
                        @endif
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Prezzo</label>
                        <input type="number" class="form-control" placeholder="Prezzo" id="price" name="price" value="{{ old('price') ?? $apartment->price }}" required>
                        <div class="valid-feedback">
                            prezzo valido!
                          </div>
                        @if ($errors->any())
                        <div class="text-danger">{{ $errors->first('price') }}</div>
                        @endif
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Cancellazione gratuita?</label>
                        <select class="form-control" name="free_cancellation" id="free_cancellation" required>
                            <option selected disabled value="">seleziona...</option>
                            <option value="1" {{ old('free_cancellation') == 1 ? 'selected' : '' }}>si</option>
                            <option value="0" {{ old('free_cancellation') == 0 ? 'selected' : '' }}>no</option>
                        </select>
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
                        <button type="submit" class="btn btn-sm btn-success">Modifica appartamento</button>
                    </div>
            </form>
        </div>
    </div>
@endsection