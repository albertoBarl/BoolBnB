@extends('layouts.admin')
@section('content')

<h2 class="my-4 mx-3 mt-5">
    {{ __('Servizi') }}
</h2>

@foreach ($services as $item)

<div class="m-3">
    <li class="my_servicesli">
        {{$item->name}}
    </li>
</div>
        
@endforeach
@endsection