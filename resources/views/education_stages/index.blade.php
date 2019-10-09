@extends("layouts.main")

@section("title")
{{ $page_title }}
@endsection

@section("content")

<div class="uk-container">
	<a href="{{ action('EducationStageController@newForm') }}" class="uk-button uk-button-primary" title="Add item">
		<span uk-icon="icon: plus;"></span>
	</a>
	<a href="" class="uk-button uk-button-default" title="refresh list">
		<span uk-icon="icon:refresh"></span>
	</a>
</div>

@include("education_stages.list")

@endsection