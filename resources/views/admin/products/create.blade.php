@extends('admin.layouts.master')


@section('title','Create Pizza Page')


@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            {{-- start row  --}}
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('products#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            {{-- end row  --}}

            {{-- start row  --}}
            <div class="row">

                <div class="col-lg-6 offset-3">
                    <div class="card">

                        <div class="card-body">

                            <div class="card-title">
                                <h3 class="text-center title-2 p-3">Create New Pizza</h3>
                            </div>

                            <hr>

                            <form action="{{Route('products#create')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf

                                <div class="form-group">
                                    <label for="productName" class="control-label mb-1">Product Name</label>
                                    <input id="productName" name="productName" type="text" value="{{ old('productName') }}" class="form-control @error('productName') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Product Name ..."/>
                                    @error('productName')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="waitingTime" class="control-label mb-1">Waiting Time</label>
                                    <input id="waitingTime" name="waitingTime" type="time" value="{{ old('waitingTime') }}" class="form-control @error('productName') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Waiting Time ..."/>
                                    @error('waitingTime')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="categoryId" class="control-label mb-1">Category Name</label>
                                    <select name="categoryId" id="categoryId" class="form-select @error('categoryId') is-invalid @enderror">
                                        <option selected disabled>Choose Category Name</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('categoryId')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description" class="control-label mb-1">Description</label>
                                    <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid  @enderror"  placeholder="Description ...">@if (old('description')) {{ old('description') }}@endif</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image" class="control-label mb-1">Image</label>
                                    <input id="image" name="image" type="file" value="{{ old('image') }}" class="form-control @error('image') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Image ..."/>
                                    @error('image')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price" class="control-label mb-1">Price</label>
                                    <input id="price" name="price" type="number" value="{{ old('price') }}" class="form-control @error('price') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Price ..."/>
                                    @error('price')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>



                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info text-white btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <i class="fas fa-arrow-right ms-3"></i>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    </button>
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
