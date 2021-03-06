@php
$rank_options = [
	['label'=> 'Instructor', 'value'=> 'instructor'],
	['label'=> 'Teacher', 'value'=> 'teacher']
];
@endphp
{{ csrf_field() }}
<fieldset class="uk-fieldset">
	<legend class="uk-legend">{{ $form_legend }}</legend>
	<div class="uk-margin"></div>
	<div>
			<label class="uk-form-label">First Name:</label>
			<div class="uk-form-controls">
				<input class="uk-input" type="text" name="firstname" required value="{{ $form->firstname }}">
			</div>
	</div>
	<div>
			<label class="uk-form-label">Middle Name:</label>
			<div class="uk-form-controls">
				<input class="uk-input" type="text" name="middlename" required value="{{ $form->middlename }}">
			</div>
	</div>
	<div>
			<label class="uk-form-label">Last Name:</label>
			<div class="uk-form-controls">
				<input class="uk-input" type="text" name="lastname" required value="{{ $form->lastname }}">
			</div>
	</div>
	<div>
			<label class="uk-form-label">Rank:</label>
			<div class="uk-form-controls">
				<select class="uk-select" name="rank" required>
					<option value="">Select</option>
					@foreach($rank_options as $rank_option)
						<option value="{{ $rank_option['value'] }}"
							@if($rank_option['value'] == $form->rank)
								selected="selected"
							@endif
						>{{ $rank_option['label'] }}</option>
					@endforeach
				</select>
			</div>
	</div>
	<div>
			<label class="uk-form-label">Email Address:</label>
			<div class="uk-form-controls">
				<input class="uk-input" type="email" name="email" required value="{{ $form->email }}">
			</div>
	</div>
	@if($form_action == 'update')
		<div>
				<label class="uk-form-label">Change Password:</label>
				<div class="uk-form-controls">
					<input class="uk-input" type="password" name="password" placeholder="Change password">
				</div>
		</div>
		<div>
				<label class="uk-form-label">Confirm Password:</label>
				<div class="uk-form-controls">
					<input class="uk-input" type="password" name="confirm_password" placeholder="Confirm password">
				</div>
		</div>
	@else 
		<div>
				<label class="uk-form-label">Password:</label>
				<div class="uk-form-controls">
					<input class="uk-input" type="text" name="password" required value="{{ $form->password }}" >
				</div>
		</div>
	@endif
	<div>
		<label class="uk-form-label">&nbsp;</label>
		<div class="uk-form-controls">
			<button class="uk-button uk-button-primary" type="submit">Save</button>
			<a href="{{ action('TeacherController@index') }}" class="uk-button uk-button-default">Cancel</a>
		</div>		
	</div>
</fieldset>