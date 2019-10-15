<table class="uk-table">
	<tr>
		<thead>
			<th>ID</th>
			<th>Subject</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@if(count($subjects) == 0)
				<tr>
					<td colspan="3" style="text-align:center">No record found</td>
				</tr>
			@endif
			@foreach($subjects as $subject)
				<tr>
					<td>{{ $subject->id }}</td>
					<td>{{ $subject->name }}</td>
					<td>Action</td>
				</tr>
			@endforeach
		</tbody>
	</tr>
</table>