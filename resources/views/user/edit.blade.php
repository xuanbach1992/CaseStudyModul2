@extends("home")
@section("content")
    <div><h1>Edit Information</h1></div>
    <div class="col-lg-6">
        <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{$product->name}}">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" class="form-control" name="price" value="{{$product->price}}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" name="description" value="{{$product->description}}">
            </div>
            <div class="form-group">
                <label>Image</label>
                <img src="{{asset("/storage/$product->image")}}" alt="image{{$product->id}}" height="150px" width="150px"><br>
                <input type="file" name="image">
            </div>
{{--            <div class="form-group">--}}
{{--                <select name="group">--}}
{{--                    <option value="">Khong trong group nao</option>--}}
{{--                    @foreach($groups as $group)--}}
{{--                        <option--}}
{{--                            @if ($user->group_id==$group->id)--}}
{{--                            selected--}}
{{--                            @endif--}}
{{--                            value="{{$group->id}}">{{$group->name}}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
            <div>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection

