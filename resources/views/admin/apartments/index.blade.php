@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between py-4">
        <div>Appartamenti</div>
        <div>
            <a href="{{ route('admin.apartments.create') }}" class="btn btn-sm btn-primary">Aggiungi nuovo appartamento</a>
        </div>
    </div>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <table class="table">
        <thead class="text-capitalize">
            <th>title</th>
            <th>description</th>
            <th>sq. ft.</th>
            <th>bathrooms</th>
            <th>bedrooms</th>
            <th>address</th>
            <th>image</th>
            <th>price</th>
            <th>actions:</th>
        </thead>
        <tbody>
            @foreach ($apartments as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->square_feet }}</td>
                    <td>{{ $item->bathroom }}</td>
                    <td>{{ $item->room }}</td>
                    <td>{{ $item->address }}</td>
                    <td class="d-inline-block text-truncate" style="max-width: 150px">{{ $item->image }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-sm btn-square btn-primary"
                                href="{{ route('admin.apartments.show', $item->slug) }}" title="Visualizza appartamento">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-square btn-warning"
                                href="{{ route('admin.apartments.edit', $item->slug) }}" title="Modifica appartamento">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.apartments.destroy', $item->slug) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-square btn-danger confirm-delete-button"
                                    data-bs-toggle="modal" data-bs-target="#delete-apartment-modal"
                                    data-title="{{ $item->title }}">
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
