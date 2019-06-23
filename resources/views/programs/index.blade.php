@extends('index')

@section('content')
@foreach($items as $item)
{{ $item->name }}
@endforeach
@endsection