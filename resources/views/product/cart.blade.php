@extends('layouts.app')
@section('content')
    <h1>{{ "Chi tiết giỏ hàng" }}</h1>
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <div class="col-12 alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ \Illuminate\Support\Facades\Session::get('success') }}</strong>
        </div>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('delete_error'))
        <div class="col-12 alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ \Illuminate\Support\Facades\Session::get('delete_error') }}</strong>
        </div>
    @endif
    <div class="col-12 col-md-12 mt-2 border">
        <table id="cart" class="table table-hover">
            <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
            @if(\Illuminate\Support\Facades\Session::has('cart'))

                @foreach($products->products as $item)
{{--                    {{dd($item)}}--}}
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-md-2 hidden-xs"><img
                                        src="{{ asset('storage/' .$item["product"]->image) }}"
                                        alt="..."
                                        class="img-responsive" width="100%"/>
                                </div>
                                <div class="col-md-10">
                                    <h4 class="nomargin">{{ $item["product"]->name }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">{{$item["product"]->price }}</td>
                        <td class="border-0 align-middle"><strong>
                                <ul class="pagination ">
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="{{route('cart.subProductIntoCart',$item["product"]->id)}}">-</a>
                                    </li>
                                    <li class="page-item border-dark">{{$item['totalQty']}}</li>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="{{route('cart.plusProductIntoCart',$item["product"]->id)}}">+</a>
                                    </li>
                                </ul>
                            </strong>
                        </td>
                        <td data-th="Subtotal" class="text-center">{{$item['price']}}</td>
                        <td class="actions" data-th="">
                            <a class="btn btn-danger btn-sm"
                               href="{{route('cart.deleteProduct', $item["product"]->id) }}">mua sau</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td><a href="{{route('product.list')}}" class="btn btn-warning ">Continue Shopping
                    </a>
                </td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Tổng tiền: {{$products->totalPrice}}</strong></td>
                <td><a href="#" class="btn btn-success btn-block">Checkout</a></td>
            </tr>
            </tfoot>
            @else
                <tr>
                    <td colspan="5" class="text-center"><p>{{ "Bạn chưa mua sản phẩm nào" }}</p></td>
                </tr>
            @endif
        </table>

    </div>

@endsection
