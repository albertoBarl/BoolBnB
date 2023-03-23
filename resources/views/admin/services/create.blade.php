@extends('layouts.admin')
@section('content')
<form action="{{route('admin.services.store')}}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="" class="form-label">Aggiungi servizio</label>
      <input type="text" class="form-control" id="" aria-describedby="" name="name">
    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-primary">Aggiungi nuovo servizio</button>
    </div>
  </form>
@endsection