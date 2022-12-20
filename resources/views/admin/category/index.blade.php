@extends('admin.master')
@section('content')
    <div class="container">
        @csrf
        @if(session('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>{{session('success')}}</strong> 
            </div>
            
            <script>
              $(".alert").alert();
            </script>
        @endif
        <a href="{{route('category.create')}}" class="btn btn-success">ADD</a>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{!! $item->status ? '<span class="badge badge-pill badge-primary">Hiện</span>' : '<span class="badge badge-pill badge-danger">Ẩn</span>' !!}</td>      
                        <td class="d-flex">
                            <form action="{{route('category.destroy',$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                            <a href="{{route('category.edit',$item->id)}}" class="btn btn-primary" >Sửa</a>
                        </td>
                    </tr>
                @endforeach
                <a href="{{route('category.softDelete')}}" title="Thùng rác">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJ13Fw8Nid9UTieyvpXQXvV50B-6LDOP1AtA&usqp=CAU" alt="" width="100px">
                </a>

            </tbody>
        </table>
        {{$categories->links()}}
    </div>
@stop
