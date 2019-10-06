@extends("layouts.main")

@section("title")
New Student Form
@endsection

@section("content")

<form class="uk-form-stacked" method="POST">
	{{ csrf_field() }}
	<div class="uk-flex uk-flex-center">
		<div class="uk-card uk-card-default uk-card-hover uk-card-body uk-width-1-2@m">
				<h3 class="uk-card-title uk-text-center">
					Are you sure you want to delete student #{{ $form->id }} : {{ $form->firstname }} {{ $form->lastname }}
				</h3>
				<div class="uk-text-center">
					<button class="uk-button uk-button-default" type="submit">Delete</button>
					<a href="{{ action('StudentController@index') }}" class="uk-button uk-button-primary">Cancel</a>
				</div>
		</div>
	</div>
</form>

@endsection