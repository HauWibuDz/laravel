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
        <form method="POST" enctype="multipart/form-data" action="{{route('product.store')}}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Tên sản phẩm</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Giá</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="price" value="{{old('price')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Giá khuyến mãi</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="sale_price" value="{{old('sale_price')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ảnh</label>
                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="file">
            </div>
            <div class="form-group">
                <label for="">Danh mục</label>
                <select class="form-control" name="category_id" id="">
                    @foreach ($categories as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mô tả</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="description" value="{{old('description')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Trạng thái</label>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" id="" value="1" checked>
                        In Stock
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" id="" value="0"> Out of
                        stock
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">ADD</button>
        </form>
    </div>
@stop
