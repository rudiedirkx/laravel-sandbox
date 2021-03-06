<title>Laravel tests</title>

<style>
fieldset {
	padding: 5px 10px;
	margin: 10px 0;
}
.form-group {
	padding: 5px;
	margin: 5px;
}
.form-group + .form-group {
	border-top: solid 1px #aaa;
}
.control-label.required:after {
	content: " *";
	color: red;
	font-weight: bold;
}
.text-danger,
.has-error {
	color: red;
}
</style>

<p>
	  <a href="/">Home</a>
	| <a href="/organization">Organization</a>
	| <a href="/user">User</a>
	| <a href="/create-organization">Create organization</a>
	| <a href="/nested">Nested</a>
	| <a href="/school">School</a>
	| <a href="/translate">Translate</a>
	| <a href="/invoice">Invoice</a>

	| <a href="/addresses">Addresses</a>
	| <a href="/files">Files</a>

	| <a href="/queries/join">JOIN</a>
	| <a href="/queries/select">SELECT</a>
</p>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@yield('content')
