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
        <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exampleInputEmail1">Tên sản phẩm</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name"
                    value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Giá</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="price" value="{{ $product->price }}">

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Giá khuyến mãi</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="sale_price" value="{{ $product->sale_price }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ảnh</label>
                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="file" value="">
                <img src="{{ url('uploads') }}\{{ $product->image }}" alt="" width="300">
            </div>
            <div class="form-group">
                <label for="">Danh mục</label>
                <select class="form-control" name="category_id" id="">
                    @foreach ($categories as $value)
                        @if ($value->id == $product->category_id)
                            <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                        @else
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mô tả</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="description" value="{{ $product->description }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Trạng thái</label>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" id="" value="1"
                            {{ $product->status ? 'checked' : '' }}>
                        In Stock
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" id="" value="0"
                            {{ !$product->status ? 'checked' : '' }}> Out of stock
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
    </div>
@stop
