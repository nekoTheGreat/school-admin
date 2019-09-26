<ul>
@foreach($items as $item)
	<li>{{ $item->id }} : {{ $item->firstname }} {{ $item->lastname }}</li>
@endforeach
</ul>