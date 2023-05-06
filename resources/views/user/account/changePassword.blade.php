@extends('user.layouts.master')


@section('title','Change Password Page')


@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">

    <div class="section__content section__content--p30">

        <div class="container-fluid">

            {{-- start row  --}}
            <div class="row">

                <div class="col-lg-6 mx-auto">
                    <div class="card">

                        <div class="card-body">

                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>

                            <hr>

                            @if (session('feedback'))
                                <div class="alert alert-success alert-dismissible fade show ms-auto">
                                    <i class="fas fa-check me-2"></i>
                                    <strong>{{ session('feedback') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
                                </div>
                            @endif

                            <form action="{{ route('user#changePassword') }}" method="post" novalidate="novalidate">
                                @csrf

                                <div class="form-group">
                                    <label for="oldpassword" class="control-label mb-1">Old Password</label>
                                    <input id="oldpassword" name="oldPassword" type="password"  class="form-control @if(session('notMatch')) is-invalid @endif  @error('oldPassword') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Old Password ..."/>
                                    @error('oldPassword')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                    @if (session('notMatch'))
                                    <span class="text-danger">{{ session('notMatch') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="newpassword" class="control-label mb-1">New Password</label>
                                    <input id="newpassword" name="newPassword" type="password"  class="form-control @error('newPassword') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="New Password ..."/>
                                    @error('newPassword')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="confirmpassword" class="control-label mb-1">Old Password</label>
                                    <input id="confirmpassword" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm Password ..."/>
                                    @error('confirmPassword')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block text-light">
                                        <span id="payment-button-amount">Change Password</span>
                                        <i class="fas fa-key ms-3"></i>
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
