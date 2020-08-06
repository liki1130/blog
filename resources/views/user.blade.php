@extends('layouts.app')

@section('content')
    <div class="row justify-content-center" align='center' valign="middle">
        <h1 class="title">My Blog </h1>                 
        @foreach ($data as $datas)  
            Title：{{ $datas->title }}<br>
            Content：{{ $datas->content }} <br>  
            <a href="edit/{{ $datas->id }}">
                <button>Edit</button>
            </a>     
            <form action="/delete/{{ $datas->id }}" method="POST"> 
                {{ csrf_field() }}  
                <input type="submit" value="Delete">
            </form>                                
        @endforeach                                                        
    </div>
@endsection


