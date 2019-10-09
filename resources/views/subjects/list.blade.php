<table class="uk-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Category</th>
			<th>Education Stage</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($items as $item)
		<tr>
			<td>{{ $item->id }}</td>
			<td>{{ $item->name }}</td>
			<td>{{ $item->category }}</td>
			<td>{{ $item->education_stage_id }}</td>
			<td>
				<a href="{{ action('SubjectController@updateForm', ['subject_id'=>$item->id]) }}">Edit</a>&nbsp;
				<a href="{{ action('SubjectController@deleteForm', ['subject_id'=>$item->id]) }}">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>