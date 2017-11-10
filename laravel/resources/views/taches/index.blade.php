<!doctype>
<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
</head>
<body>
	<h1>Les taches</h1>
	<ul>
		@foreach($taches as $t)
			<li> {{ $t->nom }} </li>
		@endforeach
	</ul>
</body>
</html>
