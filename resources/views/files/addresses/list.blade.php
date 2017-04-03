@extends('layout')

@section('content')
	<h1>Addresses</h1>

	<p>
		{{ link_to_route('files.addresses.create', 'Create address') }}
	</p>

	<table border="1" cellspacing="0" cellpadding="7">
		<thead>
			<tr>
				<th>ID</th>
				<th>Street</th>
				<th>City</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($addresses as $address)
				<tr>
					<td>{{ $address->id }}</td>
					<td>{{ $address->street }} {{ $address->street_nr }} {{ $address->street_nr_additional }}</td>
					<td>{{ $address->city }}</td>
					<td>{{ link_to_route('files.addresses.edit', 'edit', [$address]) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
