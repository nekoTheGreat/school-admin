<table class="uk-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Stage</th>
			<th>Level</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($items as $item)
		<tr>
			<td>{{ $item->id }}</td>
			<td>{{ $item->stage }}</td>
			<td>{{ $item->level }}</td>
			<td>
				<a href="{{ action('EducationStageController@updateForm', ['classroom_id'=>$item->id]) }}">Edit</a>&nbsp;
				<a href="{{ action('EducationStageController@deleteForm', ['classroom_id'=>$item->id]) }}">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>