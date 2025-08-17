@extends('layouts.main')

@section('title', 'About')

@section('content')

<h1>About Me</h1>

<p>Name: {{ $name }}</p>
<p>Job: {{ $job }}</p>
@endsection