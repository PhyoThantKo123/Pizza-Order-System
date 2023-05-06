@extends('admin.layouts.master')


@section('title','Pizza Details Page')


@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">

    <div class="section__content section__content--p30">

        <div class="container-fluid">

            {{-- start row  --}}
            <div class="row">
                <div class="col-lg-10 offset-1">
                    <div class="text-end">
                        <button class="btn bg-dark text-white my-3" onclick="history.back()">Back</button>
                    </div>
                </div>
            </div>
            {{-- end row  --}}

            {{-- start row  --}}
            <div class="row">

                <div class="col-lg-10 offset-1">
                    <div class="card">

                        <div class="card-body">

                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Details</h3>
                            </div>

                            <hr>

                            @if (session('updated'))
                                <div class="w-75 alert alert-warning alert-dismissible fade show ms-auto">
                                    <strong>{{ session('updated') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
                                </div>
                            @endif


                            {{-- start content  --}}
                            <div class="d-flex justify-content-center p-4">

                                <div class="p-3" style="width: 40%;">
                                    <img src="{{ asset('storage/'.$pizza->image) }}" class="w-100 covers" alt="John Doe" />

                                    <div class="d-grid mt-3">
                                        <a href="{{route('products#edit',$pizza->id)}}" class="btn btn-dark">
                                            <i class="fas fa-edit me-2"></i>Edit Pizza
                                        </a>
                                    </div>
                                </div>

                                <div class="contents p-3" style="width: 60%;">

                                    <div class="d-inline-block bg-danger py-2 px-3 mb-3">
                                        <p class="fw-bold text-white fs-3 "> {{$pizza->name}}</p>
                                    </div>

                                    <div class="d-flex flex-wrap">
                                        <div class="d-inline-block bg-dark text-light p-1 mb-2 me-2">
                                            <p><span class="me-2"><i class="fas fa-money-bill-wave"></i> Price :</span>{{$pizza->price}}</p>
                                        </div>

                                        <div class="d-inline-block bg-dark text-light p-1 mb-2 me-2">
                                            <p><span class="me-2"><i class="fas fa-clock"></i> Waiting Time :</span>{{$pizza->waiting_time}}</p>
                                        </div>

                                        <div class="d-inline-block bg-dark text-light p-1 mb-2 me-2">
                                            <p><span class="me-2"><i class="fas fa-eye"></i> View Count :</span>{{$pizza->view_count}}</p>
                                        </div>

                                        <div class="d-inline-block bg-dark text-light p-1 mb-2 me-2">
                                            <p><span class="me-2"><i class="fas fa-calendar-alt"></i> Created_at :</span>{{$pizza->created_at->format('Y-M-d')}}</p>
                                        </div>

                                        <div class="d-inline-block bg-dark text-light p-1 mb-2 me-2">
                                            <p><span class="me-2"><i class="fas fa-list"></i> Category Name :</span>{{$pizza->category_name}}</p>
                                        </div>

                                    </div>

                                    <p class="mb-2"><p class="fw-bold"><i class="far fa-file-word"></i> Description : </p> {{$pizza->description}}</p>
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
