@extends('layouts.admin')
@section('content')

<h2 class="my-4">
    {{ __('Servizi') }}
</h2>

@foreach ($services as $item)

<div class="m-2">
    <li class="my_servicesli">
        {{$item->name}}
    </li>
</div>
        
@endforeach
@endsection