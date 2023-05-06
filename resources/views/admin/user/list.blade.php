@extends('admin.layouts.master')


@section('title','User List Page')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">


                <div class="d-flex justify-content-end align-items-center">
                    <div class='d-inline-block bg-white p-1 px-3 mb-4'>
                        <h4><i class="fas fa-database"></i> - {{count($users)}}</h4>
                    </div>
                </div>


            <!--START DATA TABLE -->
            <div class="table-responsive table-responsive-data2">

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


                @if (count($users) != 0)

                   <table class="table table-data2 mt-4">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="tr-shadow">
                                    <td>
                                        @if (empty($user->image))
                                            @if ($user->gender == 'male')
                                                <img src="{{ asset('storage/male.png')}}" class="img_sm covers" alt=""/>
                                            @else
                                                <img src="{{ asset('storage/female.jpg')}}" class="img_sm covers" alt=""/>
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$user->image)}}" class="img_sm covers" alt=""/>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <select idx="{{ $user->id }}" class="form-select changerole">
                                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('user#edit',$user->id)}}" class="text-decoration-none text-info fs-4 me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <a href="{{ route('user#delete',$user->id) }}" class="text-decoration-none text-danger fs-4" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fas fa-user-minus"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{$users->appends(request()->query())->links()}}
                    </div>

                @else
                    <h2 class="text-secondary text-center mt-5">There is no user here !</h2>
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
            $('.changerole').change(function(){
                let id = $(this).attr('idx');
                let role = $(this).val();
                $.ajax({
                    type : 'get',
                    url : '/ajax/role/change',
                    data : {'id' : id , 'role' : role},
                    dataType : 'json',
                    success : function (response){
                        console.log(response);
                    }
                })
            });
        });
    </script>
@endsection
