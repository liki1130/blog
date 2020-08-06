@extends('layouts.app')

@if (Session::has('flash_message'))
    <script language="JavaScript">
        (window.alert("{{ Session::get('flash_message') }}"))
    </script>
@endif

@section('content')
	<div class="row justify-content-center" align='center' valign="middle">	 
	    <h1 class="title">Edit Article</h1>
	    <form action="/update/{{ $data->id }}" method="POST">
	        <input type="hidden" name="name" value="{{ $data->name }}" />
	        Title：<input type="text" name="title" value="{{ $data->title }}" /><br>
	        Content：<textarea  style="width:300px;height:300px;" name="content">{{ $data->content }}</textarea>
	        {{ csrf_field() }}	      
	        <input type="submit" value="Enter">
	    </form>
	</div>
@endsection