<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
	<nav class="uk-navbar-container" uk-navbar>
		<div class="uk-navbar-left">
					<ul class="uk-navbar-nav">
							<li class="uk-active"><a href="/">Home</a></li>
							<li><a href="{{ action('TeacherController@index') }}">Teachers</a></a></li>
							<li><a href="{{ action('StudentController@index') }}">Students</a></li>
							<li><a href="{{ action('ClassroomController@index') }}">Classrooms</a></li>
							<li><a href="#">Subjects</a></li>
							<li><a href="{{ action('EducationStageController@index') }}">Education Stages</a></li>
					</ul>
			</div>
	</nav>
</div>