@extends('admin.layouts.master')


@section('title','Admin List Page')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">


                <div class="table-data__tool">

                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>
                        </div>
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
                        <form class="input-group w-25 ms-auto" action="{{ route('admin#list') }}" method="GET">
                            <input type="text" name="key" id="search" class="form-control" value="{{ request('key') }}" placeholder="Search Admin"/>
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>


                    @if (count($admins) != 0)

                   <table class="table table-data2 mt-4">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th class="text-end">
                                <div class='d-inline-block bg-white p-1 px-3 '>
                                    <h4><i class="fas fa-database"></i> - {{count($admins)}}</h4>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr class="tr-shadow">
                                <td>
                                    @if (empty($admin->image))
                                        @if ($admin->gender == 'male')
                                            <img src="{{ asset('storage/male.png')}}" class="img_sm covers" alt=""/>
                                        @else
                                            <img src="{{ asset('storage/female.jpg')}}" class="img_sm covers" alt=""/>
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.$admin->image)}}" class="img_sm covers" alt=""/>
                                    @endif
                                </td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->gender }}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        @if (Auth::user()->id != $admin->id)
                                            <button  idx="{{$admin->id}}" class="text-danger text-decoration-none fs-5 me-2 changerole" data-toggle="tooltip" data-placement="top" title="Change Role">
                                                <i class="fas fa-user-minus"></i>
                                            </button>
                                            <a href="{{ route('admin#delete',$admin->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{$admins->appends(request()->query())->links()}}
                </div>

                   @else
                       <h2 class="text-secondary text-center mt-5">There is no Admin here !</h2>
                   @endif

            </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $('.changerole').click(function(){
                let id = $(this).attr('idx');
                let role = 'user';
                $.ajax({
                    type : 'get',
                    url : '/ajax/role/change',
                    data : {'id' : id,'role' : role},
                    dataType : 'json',
                    success : function (response){
                        window.location.href = '/admins/list';
                    }
                })
            });
        });
    </script>
@endsection
