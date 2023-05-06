@extends('user.layouts.master')


@section('title','Cart Page')



@section('content')

 <!-- Cart Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-start">Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="data-containers">
                    @foreach ($lists as $key => $list)
                        <tr id="{{ $list->id }}">
                            <td class="align-middle text-start"><img src="{{ asset('storage/'.$list->pizza_img) }}" alt="" style="width: 50px;"> {{ $list->pizza}}</td>
                            <td class="align-middle">$ <span class="price">{{ $list->pizza_price}}</span></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center qty" value="{{ $list->qty }}" readonly>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">$ <span class="totals">{{ $list->pizza_price * $list->qty}}</span></td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger remove-btns"><i class="fa fa-times"></i></button></td>
                            <input type="hidden" class="productId" value="{{ $list->product_id }}"/>
                            <input type="hidden" class="userId" value="{{ $list->user_id }}"/>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>$ <span id="subtotal">{{ $sum }}</span></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">$ <span id="del_fee">5</span></h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>$ <span id="final-total"> @if($sum != 0) {{ $sum + 5}} @else {{ $sum }}  @endif</span></h5>
                    </div>
                    <button id="order-btn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    <a href="{{ route('user#cartDelete') }}" class="btn btn-block btn-danger font-weight-bold my-3 py-3">Delete All of Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection



@section('ajax')
    <script>

       $(document).ready(function(){


            $('.btn-minus').click(function(){
                calculate($(this));
            });


            $('.btn-plus').click(function(){
                calculate($(this));
            });


            function calculate(item){
                const parent = item.parents('tr');

                let qty = parent.find('.qty').val();
                let price = parent.find('.price').text();
                let total = price * qty;

                total = total.toFixed(2);

                parent.find('.totals').text(total);

                const getidx = parent.prop('id');

                forupdateajax(getidx,qty,'update');

                subtotal();
            };


            function subtotal(){
                let subtotal = 0;
                $('.totals').each(function(idx,row){
                    subtotal += parseFloat($(row).text());
                });


                subtotal = subtotal.toFixed(2);

                $('#subtotal').text(subtotal);

                let final = 0

                if(subtotal != 0){
                    final = parseFloat($('#del_fee').text()) + Number(subtotal);
                }

                final = final.toFixed(2);

                $('#final-total').text(final);
            };


            $('.remove-btns').click(function(){
                const parent = $(this).parents('tr');
                const getidx = parent.prop('id');

                fordeleteajax(getidx,'delete');
                parent.remove();
                subtotal();
            });




            $('#order-btn').click(function(){
                let arr = [];
                let random =  Math.floor(Math.random() * 100001);

                $('#data-containers tr').each(function(idx,content){
                    arr.push({
                        'product_id' : $(content).find('.productId').val(),
                        'user_id' : $(content).find('.userId').val(),
                        'qty' : $(content).find('.qty').val(),
                        'total_price' : $(content).find('.totals').text(),
                        'order_code' : '0000_order_code_' + random
                    });
                });

                let total = parseFloat($('#final-total').text());

                if(arr && total){
                    fororder(arr,total);
                }

            });



            function fororder(lists,total){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/order',
                    data : {'orders' : lists,'total':total},
                    dataType : 'json',
                    success : function(response){
                        $('#data-containers tr').html('');
                        $('#subtotal').text(0);
                        $('#final-total').text(0);
                        window.location.href = '/user/home';
                    }
                });
            };



            function forupdateajax(idx,qty){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/cart/update',
                    data : { 'idx' : idx, 'qty' : qty},
                    dataType : 'json',
                    success : function(response){
                        console.log(response);
                    }
                });
            };


            function fordeleteajax(idx,qty){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/cart/delete',
                    data : { 'idx' : idx},
                    dataType : 'json',
                    success : function(response){
                        console.log(response);
                    }
                });
            };

       });



    </script>
@endsection

