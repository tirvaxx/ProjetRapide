<!doctype>
<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
</head>
<body>
	<h1>Les acteurs</h1>
	<ul>
		@foreach($acteurs as $a)
			<li> {{ $a->nom }} </li>
		@endforeach
	</ul>
</body>
</html>

