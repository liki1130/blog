@extends('layouts.app')

@if (Session::has('flash_message'))
    <script language="JavaScript">
        (window.alert("{{ Session::get('flash_message') }}"))
    </script>
@endif

@section('content')
<div class="row justify-content-center" align='center' valign="middle">	 
	<h1>Add Article</h1><br><br> 
    <form action="/store" method="POST">
        <input type="hidden" name='name' value="{{ Auth::user()->name }}" ><br>		
        Title：<input type="text" name="title" /><br>
        Content：<textarea style="width:300px;height:300px;" name="content" /></textarea>
        {{ csrf_field() }}
        <input type="submit" value="送出" />
    </form>
</div>    
@endsection