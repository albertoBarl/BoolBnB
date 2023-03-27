@extends('layouts.admin')
@section('content')
<div class="contaier">
    <div class="row">
        <div class="col-12 my-5">
            <h2>Aggiungi Nuovo Messaggio</h2>
        </div>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="col-12">
            <form action="{{ route('admin.messages.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="control-label">
                        Name
                    </label>
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Surname
                    </label>
                    <input type="text" class="form-control" placeholder="Surname" id="surname" name="surname">
                    @error('surname')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Email
                    </label>
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                    @error('email')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label class="control-label">
                         Contenuto
                    </label>
                    <input type="text" class="form-control" placeholder="Contenuto" id="content" name="content">
                    @error('content')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label class="control-label">
                         Apartment ID
                    </label>
                    <input type="text" class="form-control" placeholder="ID" id="apartment_id" name="apartment_id">
                    @error('apartment_id')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-success">Salva il Messaggio</button>
                </div>
            </form>    
        </div>    
    </div>
</div>
@endsection