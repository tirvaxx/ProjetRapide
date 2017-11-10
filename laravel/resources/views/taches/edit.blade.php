@extends('layout')

@section('content')

{{ Form::open(array('url' => '/taches/update', 'method' => 'put')) }}
{{ Form::token() }}
{ Form::label('Nom :') }}
{{ Form::input('text', 'nom') }}
{ Form::label('Description :') }}
{{ Form::input('textarea', 'description') }}

{{ Form::submit('Enregistrer') }}

{{ Form::close() }}


@endsection
