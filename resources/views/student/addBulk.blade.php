@extends('layouts.app')
@section('content')
    <form action="/addBulkStud" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="csv" required>
        <input type="submit">
    </form>
@endsection