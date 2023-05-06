@extends('admin.layouts.master')


@section('title','Products List Page')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">


            <div class="table-data__tool">

                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Products List</h2>
                    </div>
                </div>

                <div class="table-data__tool-right">
                    <a href="{{ route('products#createPage') }}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Add Product
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                    </button>
                </div>

            </div>


            <div class="d-flex justify-content-between align-items-centerb">

                <h4 class="text-uppercase">Search : <span class="text-danger"> {{request('key')}}  </span></h4>

                <form class="input-group w-25 ms-auto" action="{{ route('products#list') }}" method="GET">
                    <input type="text" name="key" id="search" class="form-control" value="{{ request('key') }}" placeholder="Search Pizza"/>
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

            </div>


            <!--START DATA TABLE -->
            <div class="table-responsive table-responsive-data2 mt-4">

                @if (session('created'))
                    <div class="w-75 alert alert-success alert-dismissible fade show ms-auto">
                        <strong>{{ session('created') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
                    </div>
                @endif

                @if (session('deleted'))
                    <div class="w-75 alert alert-danger alert-dismissible fade show ms-auto">
                        <strong>{{ session('deleted') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
                    </div>
                @endif

                @if (session('updated'))
                    <div class="w-75 alert alert-warning alert-dismissible fade show ms-auto">
                        <strong>{{ session('updated') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
                    </div>
                @endif

                @if (count($pizzas) != 0)

                <table class="table table-data2 text-center mt-4">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>View Count</th>
                            <th class="text-end">
                                <div class='d-inline-block bg-white p-1 px-3 '>
                                    <h4><i class="fas fa-database"></i> - {{ $pizzas->total() }}</h4>
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pizzas as $pizza)
                            <tr class="tr-shadow">
                                <td>
                                    <img src="{{ asset('storage/'.$pizza->image)}}" class="img_sm covers" alt=""/>
                                </td>
                                <td>{{ $pizza->name }}</td>
                                <td>{{$pizza->price}}</td>
                                <td>{{ $pizza->category_name }}</td>
                                <td>{{ $pizza->view_count }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('products#details',$pizza->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>
                                        <a href="{{route('products#edit',$pizza->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="{{route('products#delete',$pizza->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                    </tbody>

                </table>


                <div class="mt-4">
                    {{$pizzas->links()}}
                </div>

                @else

                    <div class="mt-4">
                        <h2 class="text-center ">There is no pizzas !</h2>
                    </div>

                @endif




            </div>
            <!-- END DATA TABLE -->

        </div>
    </div>
</div>

@endsection
