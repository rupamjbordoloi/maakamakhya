@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    @role('admin')
    <strong>Admin</strong>
	@endrole

    @role('manager')
    <strong>Manager</strong>
	@endrole



    </div>
</div>
@endsection
