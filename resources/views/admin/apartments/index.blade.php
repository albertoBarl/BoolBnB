@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between py-4">
        <div><h2>Appartamenti</h2></div>
        <div>
            <a href="{{ route('admin.apartments.create') }}" class="btn btn-sm btn-outline-dark">Aggiungi nuovo appartamento</a>
        </div>
    </div>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <!-- <th>id</th>
            <th>user id</th> -->
            <th>titolo</th>
            <!-- <th>slug</th> -->
            <th>descrizione</th>
            <th>metri quadrati</th>
            <th>bagni</th>
            <th>camere</th>
            <th>indirizzo</th>
            <th>immagini</th>
            <!-- <th>coordinate</th> -->
            <th>prezzo</th>
            <th>cancellazione gratuita</th>
            <th>funzioni</th>
        </thead>
        <tbody>
            @foreach ($apartments as $item)
                <tr>
                    <!-- <td>{{ $item->id }}</td>
                    <td>{{ $item->user_id }}</td> -->
                    <td>{{ $item->title }}</td>
                    <!-- <td>{{ $item->slug }}</td> -->
                    <td class="text-truncate" style="max-width: 150px">{{ $item->description }}</td>
                    <td>{{ $item->square_feet }}</td>
                    <td>{{ $item->bathroom }}</td>
                    <td>{{ $item->room }}</td>
                    <td>{{ $item->address }}</td>
                    <td class="text-truncate" style="max-width: 150px"> <img :src="{{ $item->image }}" alt="{{ $item->title }}" class="img-fluid"></td>
                    <!-- <td>{{ $item->latitude }} - {{ $item->longitude }}</td> -->
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->free_cancellation }}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-sm btn-square btn-primary mx-1" href="{{ route('admin.apartments.show', $item->slug)}}" title="Visualizza appartamento">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-square btn-warning mx-1" href="{{ route('admin.apartments.edit', $item->slug)}}" title="Modifica appartamento">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.apartments.destroy', $item->slug)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-square btn-danger confirm-delete-button mx-1" data-bs-toggle="modal" data-bs-target="#delete-apartment-modal" data-title="{{$item->title}}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('layouts.modals')
@endsection