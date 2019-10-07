<table class="uk-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($items as $item)
		<tr>
			<td>{{ $item->id }}</td>
			<td>{{ $item->name }}</td>
			<td>
				<a href="{{ action('ClassroomController@updateForm', ['classroom_id'=>$item->id]) }}">Edit</a>&nbsp;
				<a href="{{ action('ClassroomController@deleteForm', ['classroom_id'=>$item->id]) }}">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>