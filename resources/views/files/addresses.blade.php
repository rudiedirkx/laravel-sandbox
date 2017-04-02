@extends('layout')

@section('content')
	<h1>Addresses</h1>

	<p>{{ link_to_route('files.addresses.create', 'Create address') }}</p>

	@foreach ($addresses as $address)
		<tr>
			<td>{{ $address->id }}</td>
		</tr>
	@endforeach
@endsection
