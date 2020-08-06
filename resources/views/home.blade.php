@extends('layouts.app')

@section('content')
    <div class="title" align='center' valign="middle">Home<br>
    	<a href="/create">
            <button>Add</button><br><br>
        </a> 
    </div>
    @foreach ($show as $shows)  
        <div class="row justify-content-center" align='center' valign="middle"  >●{{ $shows->title }}
        	<a style="links" href="article/{{ $shows->id }}">Read</a><br><br>
        </div>
    @endforeach
@endsection