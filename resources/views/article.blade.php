@extends('layouts.app')

@if (Session::has('flash_message'))
    <script language="JavaScript">
        (window.alert("{{ Session::get('flash_message') }}"))
    </script>
@endif

@section('content')
	<div class="row justify-content-center" align='center' valign="middle">
    	<h1>●{{ $data->title }}&emsp;Author：{{ $data->name }}<br></h1>
        {{ $data->content }}<br>
        <a href="/edit/{{ $data->id }}">              
            <button>Edit</button>               
        </a>        
        <form action="/delete/{{ $data->id }}" method="POST">
            {{ csrf_field() }}   
            <input type="submit" value="Delete">
        </form>
    </div>
@endsection