@extends('jauth::layouts.layout')
@section('content')
<p>已登陆</p>
@auth
<form action="{{route("logout")}}" method="POST">
    @csrf
    <button type="submit">退出</button>
</form>
@endauth
@endsection