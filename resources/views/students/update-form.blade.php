@extends("layouts.main")

@section("title")
{{ $page_title }}
@endsection

@section("content")

<ul class="uk-tab">
	<li class="@if($form_name == 'index') uk-active @endif">
			<a href="{{ action('StudentController@updateForm', [$form->id]) }}">Information</a>
	</li>
	<li class="@if($form_name == 'subjects') uk-active @endif">
		<a href="{{ action('StudentController@listSubjects', [$form->id]) }}">Subjects</a>
	</li>
</ul>

@if($form_name == 'index')
<form class="uk-form-stacked" method="POST">
	@include("students.form")
</form>
@elseif($form_name == 'subjects')
	@include("students.form-subjects")
@endif

@endsection