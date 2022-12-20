@extends('master')
@section('main')

    <div class="card mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img class="card-img-top mt-5" src="{{ url('uploads') }}/{{ $product->image }}" alt=""
                        height="500px" width="200px">
                </div>
                <div class="card-body col-lg-6">
                    <h4 class="card-title text-center">{{ $product->name }}</h4>
                    
                    <p>Giá gốc: <del class="mr-5">{{ $product->price }}</del></p>
                    <p>Giá khuyến mãi: 
                        <strong class="">{{ $product->sale_price }}</strong> 
                        <small>({{ number_format((1 - $product->sale_price / $product->price) * 100) }}%)</small>
                    </p>
                    
                    <p class="card-text">Danh mục: {{ $product->categories->name }}</p>
                    <p class="card-text">Mô tả: {{ $product->description }}</p>
                    <p class="card-text">Trạng thái: {!! $product->status
                        ? '<span class="badge badge-pill badge-primary">In stock</span>'
                        : '<span class="badge badge-pill badge-danger">Out of stock</span>' !!}</p>

                    <form action="{{route('cart.add',$product->id)}}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <input type="text" value="1" class="form-control" name="quantity">
                        </div>
                        <button type="submit" class="btn btn-block btn-success">Add to cart</button>
                    </form>    
                </div>
            </div>
        </div>
    </div>
@stop
