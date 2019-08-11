@extends('layout')

@section('content')
	<h1>{{ $address ? 'Edit' : 'Create' }} address</h1>

	{!! form($form) !!}
@endsection
