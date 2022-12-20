@extends('master')
@section('main')



    <div class="container mt-5">
        <h1 class="text-center bg-primary">Cart</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        {{-- <td>{{ $item->product->name }}</td> --}}
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
