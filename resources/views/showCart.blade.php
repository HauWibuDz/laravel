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
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td><img src="{{ url('uploads') }}/{{ $item['image'] }}" alt="" width="100px"></td>
                        <td>{{ $item['price'] }}</td>
                        <td>
                            <form action="" class="form-inline" >
                                <div class="form-group">
                                    <input type="text" name="quantity" value="{{ $item['quantity'] }}"
                                        class="form-control" >
                                </div>
                                <td>{{ $item['quantity'] * $item['price'] }}</td>
                                <td><button class="btn btn-success" type="submit">Update</button></td>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>      
            <td></td>      
            <td></td>           
            <td class="" width="250px"><h1>Total All:</h1></td>
            <td><h1>abc</h1></td>
        </tr>
        </table>
    </div>
@stop
