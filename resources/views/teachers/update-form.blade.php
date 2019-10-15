@extends("layouts.main")

@section("title")
{{ $page_title }}
@endsection

@section("content")

<ul class="uk-tab">
	<li class="@if($form_name == 'index') uk-active @endif">
			<a href="{{ action('TeacherController@updateForm', [$form->id]) }}">Information</a>
	</li>
	<li class="@if($form_name == 'subjects') uk-active @endif">
		<a href="{{ action('TeacherController@listSubjects', [$form->id]) }}">Subjects</a>
	</li>
</ul>

@if($form_name == 'index')
	<form class="uk-form-stacked" method="POST">
		@include("teachers.form")
	</form>
@elseif($form_name == 'subjects')
	<form class="uk-form-stacked" method="POST">
		@include("teachers.form-subjects")
	</form>
@endif

@endsection