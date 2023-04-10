@extends('layouts.admin')
@section('content')
    <div class="contaier">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between px-3">
                    <div>
                    <h2>
                        {{ __('Messaggi') }}
                    </h2>
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
                </div>
            </div>
            <div class="col-12 flex-wrap" >
                        @foreach ($messages as $msg)
                            <div class="card m-3 p-3">
                                <div><strong>Da:</strong> {{$msg->email}} - {{ $msg->apartment_title }}</div>
                                <div><strong>Messaggio:</strong> {{$msg->content}}</div>
                                <div class="d-flex">
                                {{-- <div class="mt-2">
                                    <a href="{{ route('admin.messages.show', $msg->slug)}}" title="Visualizza Progetto" class="btn btn-primary btn-sm btn-square">
                                            <i class="fas fa-eye"></i>
                                    </a>
                                </div> --}}
                                </div>
                            </div>
                        @endforeach
            </div>
        </div>
    </div>
@endsection