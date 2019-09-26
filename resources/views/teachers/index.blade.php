@extends("layouts.main")

@section("title")
Teachers List
@endsection

@section("content")
<ul>
@foreach($items as $item)
	<li>{{ $item->id }} : {{ $item->firstname }} {{ $item->lastname }}</li>
@endforeach
</ul>
@endsection