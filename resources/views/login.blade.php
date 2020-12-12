@extends('jauth::layouts.layout')
@section('content')
<form action="{{$action}}" method="POST">
    @csrf
    <input type="text" name="account">
    <input type="text" name="password">
    <input type="text" hidden name="type" value="password">
    <button type="submit">提交</button>
</form>
@endsection