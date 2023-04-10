@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="col-12">
            <h2 class="py-3">Aggiungi nuovo appartmento</h2>
        </div>
        <div class="col-12 py-3">
            <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data"
                class="needs-validation" novalidate>
                @csrf
                <div class="form-group my-3">
                    <label class="control-label">Titolo</label>
                    <input type="text" class="form-control" placeholder="Title" id="title" name="title" required>
                    <div class="valid-feedback">

                        il titolo inserito è valido!
                      </div>
                      <div class="invalid-feedback">
                        il titolo inserito non è valido!
                      </div>

                </div>
                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Textarea</label>
                    <textarea class="form-control" id="validationTextarea" placeholder="Required example textarea" required
                        placeholder="descriprion" name="description"></textarea>
                    <div class="invalid-feedback">

                        la descrizione inserita è valida!

                    </div>
                    <div class="valid-feedback">
                        la descrizione è valida!
                    </div>
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Metri quadri</label>
                    <input type="number" class="form-control" placeholder="Metratura stanza" id="square_feet"
                        name="square_feet" required>

                        <div class="valid-feedback">
                            i metri quadri sono validi!
                        </div>
                        <div class="invalid-feedback">
                            i metri quadri inseriti non sono validi!
                        </div>

                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Bagni</label>
                    <input type="number" class="form-control" placeholder="Numero bagni" id="bathroom" name="bathroom"
                        required>
                    <div class="valid-feedback">
                        il numero di bagni è valido!
                    </div>
                    <div class="invalid-feedback">
                        il numero di bagni inseriti non è valido!
                    </div>
                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Stanze</label>
                    <input type="number" class="form-control" placeholder="Numero stanze" id="room" name="room"
                        required>
                    <div class="valid-feedback">
                        il numero di stanze è valido!
                    </div>
                    <div class="invalid-feedback">
                        il numero di stanze inserite non è valido!
                    </div>
                </div>
                <div class="form-group my-3">
                    <label class="control-label">n. Posti letto</label>
                    <input type="number" class="form-control" placeholder="Numero posti letto" id="bed" name="bed"
                        required>
                    <div class="valid-feedback">
                        il numero di posti letto è valido!
                    </div>
                    <div class="invalid-feedback">
                        il numero di posti letto inserite non è valido!
                    </div>
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Indirizzo</label>
                    <input type="text" class="form-control" placeholder="Indirizzo" id="address" name="address"
                        required>
                    <div class="valid-feedback">
                        l'indirizzo è valido!
                    </div>
                    <div class="invalid-feedback">
                        l'indirizzo non è valido!
                    </div>
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <input type="file" name="image" id="image"
                        class="form-control
                    @error('image')is-invalid @enderror" required>
                    <div class="invalid-feedback">
                        <ul class="text-danger">
                            <li>
                                formati compatibili: jpeg,png,jpg,gif,svg
                            </li>
                            <li>
                                dimensione massima 2mb
                            </li>
                        </ul>
                    </div>
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
                    <button type="submit" class="btn btn-sm btn-success">Salva appartamento</button>
                </div>
            </form>
        </div>
    </div>
@endsection
