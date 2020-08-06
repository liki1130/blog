@extends('layouts.app')

@section('content')
    <div class="title" align='center' valign="middle">User</div><br><br>
    @foreach ($data as $datas)  
        <div class="row justify-content-center" align='center' valign="middle">
        	●Name: {{ $datas->name }}<br>Email: {{ $datas->email }}
        </div><br><br>
    @endforeach
@endsection