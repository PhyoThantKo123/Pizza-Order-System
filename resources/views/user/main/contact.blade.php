@extends('user.layouts.master')


@section('title','Home Page')



@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-6 mx-auto">

            @if (session('feedback'))
                <div class="alert alert-success alert-dismissible fade show ms-auto mb-3">
                    <i class="fas fa-check me-2"></i>
                    <strong>{{ session('feedback') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
                </div>
            @endif

             <div class="bg-white rounded p-3">
                <h3 class="text-center mb-4">Contact Us</h3>
                <form action="{{ route('contact#add')}}" method="post" class="form">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name ..."/>
                        @error('name')
                            <span class="text-danger">{{ $message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email ..."/>
                        @error('email')
                            <span class="text-danger">{{ $message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" rows="5" class="form-control" placeholder="Enter Message">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-danger">{{ $message}}</span>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
             </div>

        </div>


    </div>
</div>

@endsection


