@if($form_sub_name == 'index')

<div class="uk-container">
	<a href="{{ action('TeacherController@attachSubjectsForm', ['teacher_id'=> $form->id]) }}" class="uk-button uk-button-primary" title="Add item">
		<span uk-icon="icon: plus;"></span>
	</a>
	<a href="" class="uk-button uk-button-default" title="refresh list">
		<span uk-icon="icon:refresh"></span>
	</a>
</div>


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

@elseif($form_sub_name == 'create')
<div id="form_list">

	<form class="uk-form-stacked" action="POST">
		<input type="hidden" name="teacher_id" value="{{ $form->id }}">
		<input type="hidden" name="subjects" :value="subjectsField">
		<fieldset class="uk-fieldset">
			<legend class="uk-legend">{{ $page_title }}</legend>
			<div class="uk-margin"></div>
			<div>
					<label class="uk-form-label">Find Subject:</label>
					<div class="uk-form-controls">
						<input class="uk-input" type="text" v-model="subject" v-on:keyup.enter="addItem()">
					</div>
			</div>
			<div>
				<table class="uk-table">
					<tbody>
						<template v-for="item in items">
							<tr>
								<td>@{{ item.name }}</td>
								<td><a href="/#" v-on:click="removeItem($event, item.id)"><span uk-icon="trash"></span></a></td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
			<div>
				<label class="uk-form-label">&nbsp;</label>
				<div class="uk-form-controls">
					<button class="uk-button uk-button-primary" type="submit">Save</button>
					<a href="{{ action('TeacherController@listSubjects', [$form->id]) }}" class="uk-button uk-button-default">Cancel</a>
				</div>		
			</div>
		</fieldset>
	</form>

</div>
<script>
	// prevent form submit after text field on enter
	$(document).on('keyup keypress', '#form_list form input[type="text"]', function(e) {
		if(e.which == 13) {
			e.preventDefault();
			return false;
		}
	});
	new Vue({
		el: '#form_list',
		data: function(){
			return {
				subject: "",
				items: []
			}
		},
		computed: {
			subjectsField: function(){
				return JSON.stringify(this.items);
			}
		},
		methods: {
			addItem: function(){
				var item = {
					name: 'Subject '+this.subject,
					id: Math.floor(Math.random() * 100000)
				};
				this.items.push(item);
				this.subject = "";
			},
			removeItem: function(evt, id){
				evt.preventDefault();
				var index = this.items.findIndex(function(item){
					return item.id == id;
				});
				if(index > -1){
					this.items.splice(index, 1);
				}
			}
		}
	});
</script>

@endif