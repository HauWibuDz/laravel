@extends('admin.master')
@section('content')
    <div class="container">
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
        <a href="{{route('product.create')}}" class="btn btn-success">ADD</a>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Giá khuyến mãi</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->sale_price }}</td>
                        <td><img src="{{url('uploads')}}/{{$item->image}}" alt="" width='100px'></td>
                        <td>{{ $item->categories->name }}</td>
                        <td>{{$item->description}}</td>
                        <td>{!! $item->status ? '<span class="badge badge-pill badge-primary">In stock</span>' : '<span class="badge badge-pill badge-danger">Out of stock</span>' !!}</td>
                        <td class="d-flex">
                            <form action="{{route('product.destroy',$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                            <a href="{{route('product.edit',$item->id)}}" class="btn btn-primary" >Sửa</a>
                        </td>
                    </tr>
                @endforeach
                <a href="{{route('product.softDelete')}}" title="Thùng rác">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJ13Fw8Nid9UTieyvpXQXvV50B-6LDOP1AtA&usqp=CAU" alt="" width="100px">
                </a>

            </tbody>
        </table>
        {{$product->links()}}
    </div>
@stop
