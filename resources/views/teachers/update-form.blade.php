@extends("layouts.main")

@section("title")
New Teacher Form
@endsection

@section("content")

<form class="uk-form-stacked" method="POST">
	@include("teachers.form")
</form>

@endsection