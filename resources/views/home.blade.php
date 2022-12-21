@extends('master')
@section('main')
    <div class="container-fruid">
        <div class="row">
            <div class="col-lg-2">
                <ul class="list-group">
                    <li class="list-group-item align-items-center active text-center">
                        Danh mục
                        
                    </li>
                    @foreach ($categories as $item)
                        <a href="{{route('danhmuc',$item->id)}}" class="list-group-item btn btn-success " width="100%">{{$item->name}}</a>
                    @endforeach
                </ul>

            </div>
            <div class="col-lg-10">
                <div class="jumbotron container-fruid">
                    <h1 class="display-3">Home ne</h1>
                    <p class="lead">Jumbo helper text</p>
                    <hr class="my-2">
                    <p>More info</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
                    </p>
                </div>
                    <div class="container-fruid">
                        <h1 class="text-center bg-danger">Sản phẩm mới</h1>
                        <div class="row">
                            @foreach ($product as $item)
                                <div class="col-lg-4 mt-4">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ url('uploads') }}/{{ $item->image }}"
                                            alt="" height="200px">
                                        <div class="card-body ">
                                            <h4 class="card-title text-center">{{ $item->name }}</h4>
                                            <p class="card-text">Giá: {{ $item->price }}</p>
                                            <p class="card-text ">Danh mục: {{ $item->categories->name }}</p>
                                            <p class="card-text">Mô tả: {{ $item->description }}</p>
                                            <p class="card-text">Trạng thái: {!! $item->status
                                                ? '<span class="badge badge-pill badge-primary">In stock</span>'
                                                : '<span class="badge badge-pill badge-danger">Out of stock</span>' !!}</p>
                                        </div>
                                        <a href="{{ route('show', $item->id) }}"><button class="btn btn-primary">Xem
                                                chi tiết</button></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="container-fruid mt-5">
                        <h1 class="text-center bg-danger">Sản phẩm Sale</h1>
                        <div class="row">
                            @foreach ($product as $item)
                                <div class="col-lg-4 mt-4">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ url('uploads') }}/{{ $item->image }}"
                                            alt="" height="200px">
                                        <div class="card-body ">
                                            <h4 class="card-title text-center">{{ $item->name }}</h4>
                                            <del class="mr-5">{{ $item->price }}</del><strong
                                                class="mr-2">{{ $item->sale_price }}</strong><small>({{ number_format((1 - $item->sale_price / $item->price) * 100) }}%)</small>
                                            <p class="card-text">Danh mục: {{ $item->categories->name }}</p>
                                            <p class="card-text">Mô tả: {{ $item->description }}</p>
                                            <p class="card-text">Trạng thái: {!! $item->status
                                                ? '<span class="badge badge-pill badge-primary">In stock</span>'
                                                : '<span class="badge badge-pill badge-danger">Out of stock</span>' !!}</p>
                                        </div>
                                        <a href="{{ route('show', $item->id) }}"><button class="btn btn-primary">Xem chi
                                                tiết</button></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $product->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
