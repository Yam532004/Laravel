@extends('layouts.client')

@section('title')
{{ $title }}
@endsection

@section('content')
@if (session('msg'))
<div class="alert alert-success"> {{session('msg')}}</div>
@endif
<h1>{{ $title }}</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%">STT</th>
            <th>Name</th>
            <th>Email</th>
            <th wdth="15%">Create_time</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($users))
        @foreach($users as $key => $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->fullname}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->create_at}}</td>
        </tr>
        @endforeach
        @else
        <td colspan="4"> NO Users</td>
        @endif
    </tbody>
</table>
@endsection