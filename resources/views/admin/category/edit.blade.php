@extends('admin.master')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{route('category.update',$categories->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exampleInputEmail1">Tên danh mục</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{$categories->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Trạng thái</label>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" id="" value="1" {{$categories->status ? 'checked' : ''}}>
                        Hiện
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" id="" value="0" {{!$categories->status ? 'checked' : ''}}> Ẩn
                    </label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
    </div>
@stop
