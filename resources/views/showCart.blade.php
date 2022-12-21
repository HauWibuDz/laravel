@extends('master')
@section('main')

    @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{ session('success') }}</strong>
        </div>

        <script>
            $(".alert").alert();
        </script>
    @endif

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
                    <th></th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td><img src="{{ url('uploads') }}/{{ $item['image'] }}" alt="" width="100px"></td>
                        <td>{{ $item['price'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item['product_id']) }}" class="form-inline"
                                method="POST">
                                @csrf
                                <div class="form-group ">
                                    <input type="text" name="quantity" value="{{ $item['quantity'] }}"
                                        class="form-control">
                                </div>

                                <button class="btn btn-success mr-2 ml-2" type="submit">Update</button>



                            </form>

                        </td>
                        <td><a href="{{ route('cart.delete', $item['product_id']) }}" class="btn btn-danger">Delete</a></td>
                        <td>{{ $item['quantity'] * $item['price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <table class="table">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="" width="250px">
                    <h1>Total All:</h1>
                </td>
            </tr>
        </table> --}}
    </div>
@stop
