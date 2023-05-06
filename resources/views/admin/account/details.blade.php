@extends('admin.layouts.master')


@section('title','Account Page')


@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">

    <div class="section__content section__content--p30">

        <div class="container-fluid">

            {{-- start row  --}}
            <div class="row">

                <div class="col-lg-8 offset-2">
                    <div class="card">

                        <div class="card-body">

                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>

                            <hr>

                            @if (session('updated'))
                                <div class="w-75 alert alert-warning alert-dismissible fade show ms-auto">
                                    <strong>{{ session('updated') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
                                </div>
                            @endif


                            {{-- start content  --}}
                            <div class="d-flex justify-content-evenly align-items-center p-4">
                                <div class="w-25 image">
                                    @if (Auth::user()->image === null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('storage/male.png')}}" class="contains" alt=""/>
                                        @else
                                            <img src="{{ asset('storage/female.jpg')}}" class="contains" alt=""/>
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="" alt="John Doe" />
                                    @endif
                                    <div class="text-center mt-3">
                                        <a href="{{route('admin#edit')}}" class="btn btn-dark">
                                            <i class="fas fa-edit me-2"></i>Edit Profile
                                        </a>
                                    </div>
                                </div>
                                <div class="contents">
                                    <p class="mb-2"><span class="fw-bold"><i class="fas fa-user"></i> Name</span> : {{Auth::user()->name}}</p>
                                    <p class="mb-2"><span class="fw-bold"><i class="fas fa-envelope"></i> Email</span> : {{Auth::user()->email}}</p>
                                    <p class="mb-2"><span class="fw-bold"><i class="fas fa-venus-mars"></i> Gender</span> : {{Auth::user()->gender}}</p>
                                    <p class="mb-2"><span class="fw-bold"><i class="fas fa-phone"></i> Phone</span> : {{Auth::user()->phone}}</p>
                                    <p class="mb-2"><span class="fw-bold"><i class="fas fa-address-card"></i> Address</span> : {{Auth::user()->address}}</p>
                                    <p class="mb-2"><span class="fw-bold"><i class="fas fa-calendar-alt"></i> Joined-Date</span> : {{Auth::user()->created_at->format('Y-M-d ')}}</p>
                                </div>
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
