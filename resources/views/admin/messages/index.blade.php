@extends('layouts.admin')
@section('content')
    <div class="contaier">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-around">
                    <div>
                        <h2>Elenco Messaggi</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.messages.create')}}" class="btn btn-sm btn-danger">Aggiungi Mesaggi</a>
                    </div>
                </div>
            </div>
            <div class="col-12 flex-wrap" >
                        @foreach ($messages as $msg)
                            <div class="card m-3">
                                <div><strong>Name:</strong>{{$msg->name}}</div>
                                <div><strong>Surname:</strong>{{$msg->surname}}</div>
                                <div><strong>Email:</strong>{{$msg->email}}</div>
                                <div><strong>Contenuto:</strong>{{$msg->content}}</div>
                                <div><strong>Slug:</strong>{{$msg->slug}}</div>
                                <div class="d-flex">
                                <div class="m-1">
                                    <a href="{{ route('admin.messages.show', $msg->slug)}}" title="Visualizza Progetto" class="btn btn-primary btn-sm btn-square">
                                            <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                </div>
                            </div>
                        @endforeach
            </div>
        </div>
    </div>
@endsection