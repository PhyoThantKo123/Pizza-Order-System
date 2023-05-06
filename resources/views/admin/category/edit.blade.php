@extends('admin.layouts.master')


@section('title','Edit Category Page')


@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Category</h3>
                        </div>
                        <hr>
                        <form action="{{ route('category#update') }}" method="post" novalidate="novalidate">
                            @csrf

                            <div class="form-group">
                                <label for="categoryName" class="control-label mb-1">Category Name</label>
                                <input type="hidden" name="categoryId" value="{{ old('categoryId',$data->id)}}">
                                <input id="categoryName" name="categoryName" type="text" value="{{ old('categoryName',$data->name) }}" class="form-control @error('categoryName') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Category Name ..."/>
                                @error('categoryName')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount ">Update</span>
                                    <i class="zmdi zmdi-edit"></i>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
