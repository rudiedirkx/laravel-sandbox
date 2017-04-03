@extends('layout')

@section('content')
	<h1>Files</h1>

	<table border="1" cellspacing="0" cellpadding="7">
		<thead>
			<tr>
				<th>ID</th>
				<th>Path</th>
				<th>Small</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($files as $file)
				<tr>
					<td>{{ $file->id }}</td>
					<td>{{ $file->filepath }}</td>
					<td>
						<a href="{{ $file->webPath('original') }}">
							<img width="40" src="{{ $file->webPath('small') }}" />
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
