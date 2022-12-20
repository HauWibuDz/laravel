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
                @forelse ($product as $item)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->sale_price }}</td>
                        <td><img src="{{url('uploads')}}/{{$item->image}}" alt="" width='100px'></td>
                        <td>{{ $item->categories->name }}</td>
                        <td>{{$item->description}}</td>
                        <td>{!! $item->status ? '<span class="badge badge-pill badge-primary">In stock</span>' : '<span class="badge badge-pill badge-danger">Out of stock</span>' !!}</td>
                        <td><a href="{{route('product.forceDelete',$item->id)}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')" >Xóa</a></td>
                        <td><a href="{{route('product.restore',$item->id)}}" class="btn btn-primary" >Khôi phục</a></td>
                    </tr>
                @empty
                    <h1>No Product</h1>
                @endforelse
            </tbody>
        </table>
        
    </div>
@stop
