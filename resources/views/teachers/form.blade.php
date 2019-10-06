<form class="uk-form-stacked" method="POST">
	{{ csrf_field() }}
	<fieldset class="uk-fieldset">
		<legend class="uk-legend">{{ $form_legend }}</legend>
		<div class="uk-margin"></div>
		<div>
				<label class="uk-form-label">First Name:</label>
				<div class="uk-form-controls">
					<input class="uk-input" type="text" name="firstname" required>
				</div>
		</div>
		<div>
				<label class="uk-form-label">Middle Name:</label>
				<div class="uk-form-controls">
					<input class="uk-input" type="text" name="middlename" required>
				</div>
		</div>
		<div>
				<label class="uk-form-label">Last Name:</label>
				<div class="uk-form-controls">
					<input class="uk-input" type="text" name="lastname" required>
				</div>
		</div>
		<div>
				<label class="uk-form-label">Rank:</label>
				<div class="uk-form-controls">
					<select class="uk-select" name="rank" required>
						<option value="">Select</option>
						<option value="instructor">Instructor</option>
						<option value="teacher">Teacher</option>
					</select>
				</div>
		</div>
		<div>
				<label class="uk-form-label">Email Address:</label>
				<div class="uk-form-controls">
					<input class="uk-input" type="email" name="email" required value="{{ $form->email }}">
				</div>
		</div>
		<div>
				<label class="uk-form-label">Password:</label>
				<div class="uk-form-controls">
					<input class="uk-input" type="text" name="password" required value="{{ $form->password }}" >
				</div>
		</div>
		<div>
			<label class="uk-form-label">&nbsp;</label>
			<div class="uk-form-controls">
				<button class="uk-button uk-button-primary" type="submit">Save</button>
				<button class="uk-button uk-button-default" type="reset">Cancel</button>
			</div>		
		</div>
	</fieldset>
</form>