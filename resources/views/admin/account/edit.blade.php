@extends('admin.layouts.master')


@section('title','Account Edit Page')


@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">

    <div class="section__content section__content--p30">

        <div class="container-fluid">

            {{-- start row  --}}
            <div class="row">

                <div class="col-lg-10 offset-1">

                    <a href="{{route('admin#details')}}" class="btn btn-dark text-white"><i class="fas fa-arrow-left me-2"></i> Back</a>

                    <div class="card mt-3">

                        <div class="card-body">

                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>

                            <hr>

                            {{-- start content  --}}
                            <div class="container p-4">
                                <form class="p-3" action="{{route('admin#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf


                                    {{-- start row  --}}
                                    <div class="row">

                                        {{-- start col-4  --}}
                                        <div class="col-md-4">
                                            <div class="image mb-4">
                                                @if (Auth::user()->image === null)
                                                    @if (Auth::user()->gender == 'male')
                                                        <img src="{{ asset('storage/male.png')}}" class="contains" alt=""/>
                                                    @else
                                                        <img src="{{ asset('storage/female.jpg')}}" class="contains" alt=""/>
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="" alt="John Doe" />
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <input type="file" name="image" class="form-control @error('image') is-valid @enderror">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="d-grid">
                                                <button class="btn btn-dark">Update <i class="fas fa-arrow-right ms-2"></i> </button>
                                            </div>
                                        </div>
                                        {{-- end col-4  --}}

                                        {{-- start col-8  --}}
                                        <div class="col-md-8">

                                            <div class="mb-3">
                                                <label for="name">Name :</label>
                                                <input type="text" class="form-control @error('name') is-invalid  @enderror" name="name" id="name" placeholder="Enter Name" value="{{ old('name',Auth::user()->name)}}"/>
                                                @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email">Eamil :</label>
                                                <input type="text" class="form-control @error('email') is-invalid  @enderror" name="email" id="email" placeholder="Enter Email" value="{{ old('email',Auth::user()->email)}}"/>
                                                @error('email')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-select @error('gender') is-invalid  @enderror">
                                                    <option value="male" @if (Auth::user()->gender == 'male')
                                                        selected
                                                    @endif>Male</option>
                                                    <option value="female" @if (Auth::user()->gender == 'female')
                                                        selected
                                                    @endif>Female</option>
                                                </select>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="name">Phone :</label>
                                                <input type="text" class="form-control @error('phone') is-invalid  @enderror" name="phone" id="phone" placeholder="Enter Phone" value="{{ old('phone',Auth::user()->phone)}}"/>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="address">Address :</label>
                                                <input type="text" class="form-control @error('address') is-invalid  @enderror" name="address" id="address" placeholder="Enter Address" value="{{ old('address',Auth::user()->address)}}"/>
                                                @error('address')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="role">Role :</label>
                                                <input type="text" class="form-control" name="role" id="role" placeholder="Enter Role" disabled value="{{ old('role',Auth::user()->role)}}"/>
                                            </div>

                                        </div>
                                        {{-- end col-8  --}}

                                    </div>
                                    {{-- end row  --}}


                                </form>

                            </div>
                            {{-- end content  --}}



                        </div>

                    </div>
                </div>

            </div>
            {{-- end row  --}}

        </div>

    </div>

</div>
<!-- END MAIN CONTENT-->

@endsection
