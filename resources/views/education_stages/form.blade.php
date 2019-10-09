{{ csrf_field() }}
<fieldset class="uk-fieldset">
	<legend class="uk-legend">{{ $form_legend }}</legend>
	<div class="uk-margin"></div>
	<div>
			<label class="uk-form-label">Stage:</label>
			<div class="uk-form-controls">
				<select class="uk-select" name="stage" required>
					<option value="">Select</option>
					@foreach($options->stages as $option)
						<option value="{{ $option['value'] }}"
							@if($option['value'] == $form->stage)
								selected="selected"
							@endif
						>{{ $option['label'] }}</option>
					@endforeach
				</select>
			</div>
	</div>
	<div>
			<label class="uk-form-label">Level:</label>
			<div class="uk-form-controls">
				<input class="uk-input" type="text" name="level" required value="{{ $form->level }}">
			</div>
	</div>
	<div>
		<label class="uk-form-label">&nbsp;</label>
		<div class="uk-form-controls">
			<button class="uk-button uk-button-primary" type="submit">Save</button>
			<a href="{{ action('EducationStageController@index') }}" class="uk-button uk-button-default">Cancel</a>
		</div>		
	</div>
</fieldset>