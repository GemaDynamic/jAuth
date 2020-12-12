@extends('jauth::layouts.layout')
@section('content')
<form action="{{$action}}" method="POST">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <input type="text" name="account">
    <input type="text" name="password">
    <input type="text" hidden name="type" value="password">
    <button type="submit">提交</button>
</form>
@endsection