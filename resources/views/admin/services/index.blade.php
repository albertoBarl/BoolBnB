@extends('layouts.admin')
@section('content')
<a class="d-flex justify-content-end" href="{{route('admin.services.create')}}">
    <button class="btn btn-primary m-3">Aggiungi nuovi servizi</button>
</a>
@foreach ($services as $item)
<div class="m-2">
    <li>
        {{$item->name}}
    </li>
</div>
        
@endforeach
@endsection