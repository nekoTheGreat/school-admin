<table class="uk-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Grade Level</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($items as $item)
		<tr>
			<td>{{ $item->id }}</td>
			<td>{{ $item->firstname }} {{ $item->lastname }}</td>
			<td>{{ $item->grade_level }}</td>
			<td>
				<a href="{{ action('StudentController@updateForm', ['student_id'=>$item->id]) }}">Edit</a>&nbsp;
				<a href="{{ action('StudentController@deleteForm', ['student_id'=>$item->id]) }}">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>