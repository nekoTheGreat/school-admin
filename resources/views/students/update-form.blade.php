@extends("layouts.main")

@section("title")
New Student Form
@endsection

@section("content")

<form class="uk-form-stacked" method="POST">
	@include("students.form")
</form>

@endsection