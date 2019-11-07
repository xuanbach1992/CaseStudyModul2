@extends("layouts.app")
@section("content")
    <form action="{{route('product.search')}}" method="post">
        @csrf
        <div>
            <a href="{{route('home')}}" class="btn btn-outline-primary">Homer</a>
            @can("admin")
                <a href="{{route('product.create')}}" class="btn btn-outline-primary">Tao moi</a>
            @endcan
            <h1 class="text-center text-primary">Products List</h1>
            @if (\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </div>
            @endif
            @cannot("admin")
                <div><a href="{{route('product.showCard')}}"><i class="fa fa-shopping-cart text-dark"
                                                                style="font-size:72px">
                            {{\Illuminate\Support\Facades\Session::has('cart')?\Illuminate\Support\Facades\Session::get('cart')->totalProduct:"0"}}
                        </i></a></div>
            @endcan
            <input type="text" placeholder="Search.." name="search">
            <button type="submit">Search</button>
        </div>
    </form>
    <div class="row ">
        @foreach($products as $product)
            <div class="col-lg-4 border border-dark">
                <div class="product">
                    <img src="{{asset("/storage/$product->image")}}" alt="image{{$product->id}}" height="250px"
                         width="200px">
                </div>
                <div class="product-body">
                    <h5 class="product-title">{{$product->name}}</h5>
                    <p class="product-description">{{$product->description}}</p><br>
                    <p class="product-price">Price: {{$product->price}}</p>
                    @cannot('admin')
                        <a href="{{route("product.addToCart",$product->id)}}" class="btn btn-success">Add to Cart</a>
                    @endcan
                    @can("admin")
                        <td><a class="btn btn-outline-dark" href="{{route('product.edit',$product->id)}}">Edit</a></td>
                        <td><a class="btn btn-outline-dark" href="{{route('product.destroy',$product->id)}}"
                               onclick="return(confirm('Are you sure?'))">Delete</a></td>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
    {{ $products->appends(request()->input())->links()}}
@endsection

