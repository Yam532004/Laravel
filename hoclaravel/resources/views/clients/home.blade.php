
@include('parts.notice')

@extends('layouts.client')
@section('content')
 <h1>Home Pages</h1>
 <button type="button" class="show">Show</button>
@endsection

@section('sidebar')
    <h3>Home sidebar</h3>
    @endsection
@section('css')
    <style>
        header{
            background: blue;
            color: #fff;
        }
    </style>
@endsection

@section('js')
       <script>
        document.querySelector('.show').onclick = function(){
            alert('Successful');
        }
       </script> 
@endsection

