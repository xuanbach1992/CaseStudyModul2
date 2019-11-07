@extends('layouts.app')
{{dd($weather)}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div>

                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @can('admin')<h1 class="text-dark"> Welcome Admin visited to website</h1>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">UserName</th>
                                <th scope="col">Email</th>
                                <th scope="col">Authorization</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $key=>$user)
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-info">
                                        @if($user->role==\App\Http\Controllers\Auth\RoleConstrant::ADMIN)
                                            Admin
                                        @else
                                            Normal User
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        @endcan
{{--                        @endif--}}
                        @cannot('admin')<h1 class="text-dark"> Welcome Guest visited to website</h1>
                        @endcan
                    </div>
                    <a href="{{route('product.list')}}" class="btn btn-outline-primary">Products</a>
                    @can("admin")
                        <a href="{{route('product.create')}}" class="btn btn-outline-dark">Create</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
