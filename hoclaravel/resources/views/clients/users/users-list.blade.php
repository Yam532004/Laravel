@extends('layouts.client')

@section('title')
{{ $title }}
@endsection

@section('content')
@if (session('msg'))
<div class="alert alert-success"> {{session('msg')}}</div>
@endif
<h1>{{ $title }}</h1>
<a href="{{ route('users.add')}}" class="btn btn-primary">Insert</a>
<hr>
<form action="" method="get" class="mb-3">
    <div class="row">
      
        <div class="col-3">
            <select class="form-control" name="group_id">
                <option value="0">Select group</option>
                @if (!empty(getAllGroup()))
                    @foreach(getAllGroup() as $item)
                        <option value="{{$item->id}}" {{request()->group_id == $item->id?'selected':false}} >{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-3">
            <select class="form-control" name="status">
                <option value="0">Select status</option>
                <option value="active" {{request()->status == "active"?'selected':true}}>Kich hoat</option>
                <option value="inactive" {{request()->status == "inactive"?'selected':true}}>Chua kich hoat</option>

            </select>
        </div>
        <div class="col-4">
            <input type="search" class="form-control" placeholder="KeyWord" name="keywords" value="{{request()->keywords}}">
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary btn-block" name="status">Search</button>
        </div>

    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%">STT</th>
            <th>Name</th>
            <th>Email</th>
            <th>Group</th>
            <th>Status</th>
            <th width="15%">Create_time</th>
            <th width="5%">Edit</th>
            <th width="5%">Delete</th>
        </tr>
    </thead>
    <tbody>

        @if(!empty($userList))
        @foreach($userList as $key => $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->fullname}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->group_name}}</td>
            <td>{!! $item->status == 0? '<button class="btn btn-danger btn-sm">Chua kich hoat</button>': '<button class="btn btn-success btn-sm">Kich hoat</button>'!!}</td>
            <td>{{$item->create_at}}</td>
            <td>
                <a href="{{route ('users.edit', ['id'=>$item->id])}}" class="btn btn-warning btn-sm">Edit</a>
            </td>
            <td>
            <a onclick="return confirm('Are you sure to remove?')" href="{{route('users.delete', ['id'=>$item->id])}}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
        @else
        <td colspan="6"> NO Users</td>
        @endif
    </tbody>
</table>
@endsection