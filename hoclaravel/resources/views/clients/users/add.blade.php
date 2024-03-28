@extends('layouts.client')

@section('title')
{{ $title }}
@endsection

@section('content')
@if (session('msg'))
<div class="alert alert-success"> {{session('msg')}}</div>
@endif
<h1>{{ $title }}</h1>

@if ($errors->any())
    <div class="alert alert-danger">Data is not confix. Please input again</div>
@endif

<form action="" method="POST">
@csrf
    <div class="mb-3">
        <label for="">Full Name: </label>
        <input type="text" class="form-control" name="fullname" placeholder="Full name..." value="{{old('fullname')}}">
        @error('fullname')
            <span style="color: red;">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="">Email: </label>
        <input type="text" class="form-control" name="email" placeholder="Email..." value="{{old('email')}}">
        @error('email')
            <span style="color: red;">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="">Group: </label>
        <select name="group_id" id="" class="form-control">
            <option value="0">Select Group</option>
           @if (!empty($allGroups))
                @foreach($allGroups as $item)
                    <option value="{{$item->id}}" {{ old('group_id') == $item->id?'selected':false }} >{{$item->name}}</option>
                @endforeach
            @endif
        </select>
        @error('group_id')
            <span style="color: red;">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="">Status : </label>
        <select name="status" id="" class="form-control">
            <option value="0" {{ old('status') == 0?'selected':false }} >Chua kich hoach</option>
            <option value="1" {{ old('status') == 1?'selected':false }}>Kich hoach</option>
        </select>
        @error('group_id')
            <span style="color: red;">{{$message}}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Add</button>
    <a href="{{ route('users.index')}}" class="btn btn-warning">Cancel</a>
</form>
@endsection