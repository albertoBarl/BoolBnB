@extends('layouts.admin')
@section('content')

@foreach ($services as $item)
<div class="m-2">
    <li>
        {{$item->name}}
    </li>
</div>
        
@endforeach
@endsection