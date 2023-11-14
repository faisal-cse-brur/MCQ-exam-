@extends('layouts.StudentLayout')

@section('admincontent')

	<div class="container">
		<div class="text-center">
			<h2>Thanks for submit Exam, {{Auth::user()->name}}</h2>
			<p>We will review your Exam and update you soon by mail</p>
			<a href="{{route('user')}}" class="btn btn-info">GO HOME</a>
		</div>
	</div>

@endsection