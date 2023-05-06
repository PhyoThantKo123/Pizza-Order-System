@extends('user.layouts.master')


@section('title','Details Page')



@section('content')

 <!-- Shop Detail Start -->
 <div class="container-fluid pb-5">

    <div class="row px-xl-5">
        <div class="col-12 mb-3">
            <a href="{{ route('user#homePage') }}" class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left me-2"></i> Back</a>
        </div>

        <div class="col-lg-5 mb-30">
            <div class="" style="height:400px;">
                <img class="w-100 h-100" src="{{ asset('storage/'.$pizza->image)}}" alt="Image">
            </div>
        </div>

        <div class="col-lg-7 mb-30">
            <div class="h-100 bg-light p-30">
                <input type="hidden" name="" id="pizzaId" value="{{ $pizza->id }}">
                <h3>{{ $pizza->name }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">{{ $pizza->view_count}} <i class="fas fa-eye"></i></small>
                </div>
                <h4 class="font-weight-semi-bold mb-4"><i class="fa-solid fa-dollar-sign"></i> {{ $pizza->price }} Kyat</h4>
                <p class="mb-4">{{ $pizza->description }}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" id="pizza_qty" class="form-control bg-secondary border-0 text-center" value="1" readonly>
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" onclick="pizza({{ Auth::user()->id }},{{ $pizza->id }})" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($lists as $list)
                        <div class="product-item bg-light">
                            <a href="{{ route('user#detailPage') }}?pizza={{$list->id}}">
                                <div class="w-100">
                                    <img class="img-fluid pizza-img w-100" src="{{ asset('storage/'.$list->image) }}" alt="">
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $list->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $list->price }}</h5><h6 class="text-muted ml-2"><del>{{ $list->price }}</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small>(99)</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->




</div>
<!-- Shop Detail End -->


@endsection


@section('ajax')

<script>

    function pizza(userid,pizzaid){
        let status = {
            userid,
            pizzaid,
            'qty' : $('#pizza_qty').val()
        };

        $.ajax({
            type : 'get',
            url : '/user/ajax/cart/add',
            data : status,
            dataType : 'json',
            success : function(response){
                if(response.status === 'success'){
                    window.location.href = '/user/home';
                }
            }
        });

    }

    // increase view count
    $.ajax({
        type : 'get',
        url : 'http://localhost:8000/user/ajax/product/viewCount',
        data : {'id' : $('#pizzaId').val() },
        dataType : 'json',
        success : function(response){
            if(response.status === 'success'){
                console.log(response);
            }
        }
    });
</script>

@endsection



