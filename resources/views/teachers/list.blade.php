<table class="uk-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Rank</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($items as $item)
		<tr>
			<td>{{ $item->id }}</td>
			<td>{{ $item->firstname }} {{ $item->lastname }}</td>
			<td>{{ $item->rank }}</td>
			<td>
				<a href="./teachers/{{ $item->id }}">Edit</a>&nbsp;
				<a href="./teachers/{{ $item->id }}/confirm-delete">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>