@extends('admin.layouts.master')


@section('title','Category List Page')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">


                <div class="table-data__tool">

                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>
                        </div>
                    </div>

                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>

                </div>


            <!--START DATA TABLE -->
            <div class="table-responsive table-responsive-data2">

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

                    <div class="d-flex justify-content-between align-items-centerb">
                        <h4 class="text-uppercase">Search : <span class="text-danger"> {{request('key')}}  </span></h4>
                        <form class="input-group w-25 ms-auto" action="{{ route('category#list') }}" method="GET">
                            <input type="text" name="key" id="search" class="form-control" value="{{ request('key') }}" placeholder="Search Category"/>
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>


                    @if (count($lists) != 0)

                   <table class="table table-data2 mt-4">
                    <thead>
                        <tr>
                            <th>
                                <p class="p-2">Id</p>
                            </th>
                            <th >
                                <p class="p-2">Cateogry Name</p>
                            </th>
                            <th>
                                <p class="p-2">Created Date</p>
                            </th>
                            <th class="text-end">
                                <div class='d-inline-block bg-white p-1 px-3 '>
                                    <h4><i class="fas fa-database"></i> - {{ $lists->total() }}</h4>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $list)
                            <tr class="tr-shadow">
                                <td>{{ $list->id }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->created_at->format('Y-M-d h:i:s a') }}</td>
                                <td>
                                    <div class="table-data-feature">

                                        <a href="{{ route('category#edit',$list->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="{{ route('category#delete',$list->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
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
                    {{$lists->appends(request()->query())->links()}}
                </div>

                   @else
                       <h2 class="text-secondary text-center mt-5">There is no category here !</h2>
                   @endif

            </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection
