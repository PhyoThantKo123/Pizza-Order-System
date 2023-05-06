@extends('user.layouts.master')


@section('title','Home Page')



@section('content')

<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">


            <!-- Category Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
            <div class="bg-light p-4 mb-30 text-dark">
                <form>
                    <div class="d-flex align-items-center justify-content-between bg-dark text-light p-2 mb-3">
                        <span>All Categories</span>
                        <span class="badge border font-weight-normal text-light">{{ count($category) + 1 }}</span>
                    </div>

                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" name="c" class="custom-control-input c-all" id="c-all"/>
                        <label class="custom-control-label" for="c-all">All</label>
                    </div>

                    @foreach ($category as $c)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="c" class="custom-control-input c" title="{{$c->id}}"  id="{{$c->name}}"/>
                            <label class="custom-control-label" for="{{ $c->name }}">{{ $c->name }}</label>
                        </div>
                    @endforeach

                </form>
            </div>
            <!-- Category End -->

        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{ route('user#cartList') }}" class="btn btn-dark me-3 rounded position-relative">
                                <i class="fas fa-shopping-cart text-light"></i>
                                <span class="badge text-light rounded-pill bg-danger position-absolute top-0 start-100 translate-middle " style="padding-bottom: 2px;">{{ count($carts) }}</span>
                            </a>
                            <a href="{{ route('orders#history') }}" class="btn btn-dark me-3 rounded position-relative">
                                <i class="fas fa-history me-2"></i>History
                                <span class="badge text-light rounded-pill bg-danger position-absolute top-0 start-100 translate-middle " style="padding-bottom: 2px;">{{ count($orders) }}</span>
                            </a>
                        </div>
                        <div class="ml-2">
                            <div class="">
                                <select name="sorting" id="sorting" class="form-select">
                                    <option value="" selected disabled>Sorting</option>
                                    <option value="asc">Firstest</option>
                                    <option value="desc">Lastest</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


               <div class="col-12" >
                    <div class="row" id="list">
                        @if (count($pizzas))
                            @foreach ($pizzas as $pizza)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <a href="{{ route('user#detailPage') }}?pizza={{$pizza->id}}">
                                        <div class="product-item bg-light mb-4">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid pizza-img w-100" src="{{ asset('storage/'.$pizza->image) }}" alt="">
                                                <!-- <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                                </div> -->
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name}}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>{{ $pizza->price }}</h5><h6 class="text-muted ml-2"><del>{{ $pizza->price }}</del></h6>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mb-1">
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <h1 class="text-center">There is no pizza <i class="fa-solid fa-pizza-slice"></i> !</h1>
                        @endif

                    </div>

               </div>

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>

@endsection



@section('ajax')
    <script>
        $(document).ready(function(){


            function addcontent(response){
                let id = response.id;
                return `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">

                        <div class="product-item bg-light mb-4">

                            <a href="{{ route('user#detailPage') }}?pizza=${id}">

                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid pizza-img w-100" src="{{ asset('storage/${response.image}') }}" alt="">
                                </div>

                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response.name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response.price}</h5><h6 class="text-muted ml-2"><del>${response.price}</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>

                            </a>

                        </div>

                    </div>
                `;
            }


            function forajax(sort,arr){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/filter',
                    data : { 'status' : sort, 'filter' : arr},
                    dataType : 'json',
                    success : function(response){
                        let list = '';

                        if(response.length > 0){
                            for(let i = 0; i < response.length; i++){
                                list += addcontent(response[i]);
                            };
                        }else{
                            list += `<h1 class="text-center">There is no pizza <i class="fa-solid fa-pizza-slice"></i> !</h1>`;
                        }

                        $('#list').html(list);

                    }
                });

            };

            let sort = '';

            $('#sorting').change(function(){
                sort = $(this).val();

                if(sort === 'desc'){
                    forajax(sort,arr);
                }else if(sort === 'asc'){
                    forajax(sort,arr);
                };

            });


            //
            let arr = [];

            $('.c').click(function(){
                let id = $(this).prop('title');
                $('#c-all').prop("checked",false);

                if($(this).is(':checked')){
                    arr.push(id);
                }else{
                    arr = arr.filter(idx => idx != id);
                }

                forajax(sort,arr);

            });


            $('#c-all').click(function(){
                if($(this).is(':checked')){
                    arr = [];
                    $('.c').prop("checked",false);
                    forajax(sort,arr);
                }
            });



        });

    </script>
@endsection
