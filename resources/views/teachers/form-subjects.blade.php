@section('append_head')
	<link href="/libs/auto-complete/auto-complete.css" rel="stylesheet">
	<script src="/libs/auto-complete/auto-complete.min.js"></script>
@endsection

<div id="teacher_subjects">
	<div class="uk-container uk-float-right">
		<button class="uk-button uk-button-primary" type="button">Save</button>
		<button class="uk-button uk-button-default" type="button" v-on:click="reset()">Reset</button>
	</div>
	<div class="uk-clearfix"></div>

	<form class="uk-form-stacked" action="POST">
		<input type="hidden" name="teacher_id" value="{{ $form->id }}">
		<input type="hidden" name="subjects" :value="subjectsField">
		<fieldset class="uk-fieldset">
			<div class="uk-margin"></div>
			<div>
					<label class="uk-form-label">Find Subject:</label>
					<div class="uk-form-controls">
						<input class="subject_options uk-input" v-model="subject" v-on:keyup.enter="addItem()">
					</div>
			</div>
		</fieldset>
	</form>
	<div>
		<table class="uk-table">
			<tbody>
				<template v-for="item in items">
					<tr>
						<td>@{{ item.name }}</td>
						<td>@{{ item.category }}</td>
						<td><a href="/#" v-on:click="removeItem($event, item.id)"><span uk-icon="trash"></span></a></td>
					</tr>
				</template>
			</tbody>
		</table>
	</div>
</div>
<script>
	// prevent form submit after text field on enter
	$(document).on('keyup keypress', '#form_list form input[type="text"]', function(e) {
		if(e.which == 13) {
			e.preventDefault();
			return false;
		}
	});
	window.config = <?=json_encode($form); ?>;

	new Vue({
		el: '#teacher_subjects',
		data: function(){
			return {
				subject: "",
				items: []
			}
		},
		computed: {
			subjectsField: function(){
				var ids = [];
				this.items.forEach(item=>{
					ids.push(item.id);
				});
				return JSON.stringify(ids);
			}
		},
		mounted: function(){
			var input = $(this.$el).find(".subject_options")[0];
			var self = this;
			this.autocomplete = new autoComplete({
				selector: input,
				minChars: 2,
				source: function(term, suggest){
					var ac = this;
					term = term.toLowerCase();
					this.items = [];
					try{ this.xhr.abort() }catch(e){}
					this.xhr = $.getJSON('/api/subjects', {q: self.subject}, function(data){
						ac.items = data.items.filter(item=>{
							return true;
						});
						suggest(data.items);
					});
				},
				renderItem: function(item, search){
					return '<div class="autocomplete-suggestion" data-val="'+item.id+'">'+item.name+'</div>';
    		},
				onSelect: function(evt, term, item){
					var id = item.getAttribute('data-val');
					var found = this.items.findIndex(it=>{
						return it.id == id;
					});
					if(found > -1){
						self.addItem(this.items[found]);
					}else{
						self.addItem(false);
					}
				}
			});

			this.getSubjects();
		},
		methods: {
			addItem: function(item){
				if(item){
					var found = this.items.findIndex(it=>{
						return it.id == item.id;
					});
					if(found == -1){
						this.items.unshift(item);
					}
				}
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
			},
			getSubjects: async function(){
				var url = '/api/subjects/teachers/'+config.id;
				const resp = await fetch(url);
				const data = await resp.json();
				this.items = data.items;
			},
			reset: function(){
				this.getSubjects();
			}
		}
	});
</script>