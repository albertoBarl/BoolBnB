@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="col-12">
            <h2 class="py-3">Aggiungi nuovo progetto</h2>
        </div>
        <div class="col-12 py-3">
            <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="text" class="form-control" placeholder="Title" id="title" name="title" required>
                    <div class="valid-feedback">
                        il titolo inserito è corretto!
                      </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Textarea</label>
                    <textarea class="form-control" id="validationTextarea" placeholder="Required example textarea" required placeholder="descriprion" name="description"></textarea>
                    <div class="invalid-feedback">
                      Please enter a message in the textarea.
                    </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Metri quadri</label>
                    <input type="number" class="form-control" placeholder="Metratura stanza" id="square_feet"
                        name="square_feet" required>
                        <div class="valid-feedback">
                            i metri quadri sono validi!
                          </div>
                    @if ($errors->any())
                            <div class="text-danger">{{ $errors->first('square_feet') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Bagni</label>
                    <input type="number" class="form-control" placeholder="Numero bagni" id="bathroom" name="bathroom" required>
                    <div class="valid-feedback">
                        i bagni sono validi!
                      </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('bathroom') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Stanze</label>
                    <input type="number" class="form-control" placeholder="Numero stanze" id="room" name="room" required>
                    <div class="valid-feedback">
                        le stanze sono validi!
                      </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('room') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Indirizzo</label>
                    <input type="text" class="form-control" placeholder="Indirizzo" id="address" name="address" required>
                    <div class="valid-feedback">
                        l'indirizzo sono validi!
                      </div>
                    @if ($errors->any())
                    <div class="text-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <input type="file" name="image" id="image"
                        class="form-control
                    @error('image')is-invalid @enderror" required>
                    @error('image')
                        <div class="text-danger">
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Latitudine</label>
                        <input type="number" class="form-control" placeholder="Latitudine" id="latitude" name="latitude" required>
                        <div class="valid-feedback">
                            latitudine valida!
                          </div>
                        @if ($errors->any())
                        <div class="text-danger">{{ $errors->first('latitude') }}</div>
                        @endif
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Longitudine</label>
                        <input type="number" class="form-control" placeholder="Longitudine" id="longitude"
                            name="longitude" required>
                        <div class="valid-feedback">
                            longitudine valida!
                        </div>
                        @if ($errors->any())
                        <div class="text-danger">{{ $errors->first('longitude') }}</div>
                        @endif
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Prezzo</label>
                        <input type="number" class="form-control" placeholder="Prezzo" id="price" name="price" required>
                        <div class="valid-feedback">
                            prezzo valida!
                        </div>
                        @if ($errors->any())
                        <div class="text-danger">{{ $errors->first('price') }}</div>
                        @endif
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Cancellazione gratuita?</label>
                        <select class="form-control" name="free_cancellation" id="free_cancellation" required>
                            <option selected disabled value="">seleziona...</option>
                            <option value="1">si</option>
                            <option value="0">no</option>
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Servizi</label>
                        @foreach ($services as $service)
                            <div>
                                <input type="checkbox" value="{{ $service->id }}" name="services[]">
                                <label class="form-check-label">{{ $service->name }}</label>
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
