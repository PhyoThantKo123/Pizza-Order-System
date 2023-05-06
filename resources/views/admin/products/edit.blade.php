@extends('admin.layouts.master')


@section('title','Edit Pizza Page')


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
                                <h3 class="text-center title-2 p-3">Edit Pizza</h3>
                            </div>

                            <hr>

                            <form action="{{route('products#update')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf

                                <input type="number" name="productId" value="{{$pizza->id}}" hidden/>

                                <div class="container">
                                    <div class="row p-3">


                                        <div class="col-md-4">
                                            <div>
                                                <img src="{{ asset('storage/'.$pizza->image) }}" class="w-100 covers" alt="John Doe" />

                                                <div class="form-group my-3">
                                                    <input id="image" name="image" type="file" class="form-control @error('image') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Image ..."/>
                                                    @error('image')
                                                        <span class="text-danger">{{ $message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <button type="submit" class="btn btn-dark">
                                                        <i class="fas fa-edit me-2"></i>Update Pizza
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- start col-8  --}}
                                        <div class="col-md-8">

                                            <div class="form-group">
                                                <label for="productName" class="control-label mb-1">Product Name</label>
                                                <input id="productName" name="productName" type="text" value="{{ old('productName',$pizza->name) }}" class="form-control @error('productName') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Product Name ..."/>
                                                @error('productName')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="waitingTime" class="control-label mb-1">Waiting Time</label>
                                                <input id="waitingTime" name="waitingTime" type="time" value="{{ old('waitingTime',$pizza->waiting_time) }}" class="form-control @error('waitingTime') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Waiting Time ..."/>
                                                @error('waitingTime')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="categoryId" class="control-label mb-1">Category Name</label>
                                                <select name="categoryId" id="categoryId" class="form-select @error('categoryId') is-invalid @enderror">
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" @if($category->id === $pizza->category_id) selected @endif>{{ $category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('categoryId')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="control-label mb-1">Description</label>
                                                <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid  @enderror"  placeholder="Description ...">@if (old('description',$pizza->description)) {{ old('description',$pizza->description) }}@endif</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="price" class="control-label mb-1">Price</label>
                                                <input id="price" name="price" type="number" value="{{ old('price',$pizza->price) }}" class="form-control @error('price') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Price ..."/>
                                                @error('price')
                                                    <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="viewCount" class="control-label mb-1">View Count</label>
                                                <input id="viewCount" name="viewCount" type="number" value="{{ old('price',$pizza->view_count) }}" class="form-control" aria-required="true" aria-invalid="false" placeholder="View Count ..." disabled/>
                                            </div>


                                            <div class="form-group">
                                                <label for="created_at" class="control-label mb-1">View Count</label>
                                                <input id="created_at" name="created_at" type="datetime-local" value="{{ old('price',$pizza->created_at) }}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Created_at ..." disabled/>
                                            </div>

                                        </div>
                                        {{-- end col-8  --}}

                                    </div>
                                </div>




                            </form>

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
