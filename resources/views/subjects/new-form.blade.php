@extends("layouts.main")

@section("title")
{{ $page_title }}
@endsection

@section("content")

<form class="uk-form-stacked" method="POST">
	@include("subjects.form")
</form>

@endsection