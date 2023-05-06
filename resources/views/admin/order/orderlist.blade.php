@extends('admin.layouts.master')


@section('title','Order List Page')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">


            <div class="mb-4">
                <a href="{{ route('orders#list') }}" class="btn"><i class="fas fa-arrow-left me-2"></i> Back</a>
            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 p-2"><i class="fas fa-user me-2"></i>Name</div>
                                <div class="col-7 p-2"><span>{{ $orderlists[0]->username }}</span></div>
                            </div>
                            <div class="row">
                                <div class="col-5 p-2"><i class="fas fa-barcode me-2"></i> Order Code</div>
                                <div class="col-7 p-2"><span>{{ $orderlists[0]->order_code }}</span></div>
                            </div>
                            <div class="row">
                                <div class="col-5 p-2"><i class="fas fa-dollar-sign me-2"></i> Total Price </div>
                                <div class="col-7 p-2"><span>{{ $order->total_price }} ($5 is deli fee)</span></div>
                            </div>
                            <div class="row">
                                <div class="col-5 p-2">
                                    @if($order->status == 0) <i class="fas fa-check me-2"></i> @endif
                                    @if($order->status == 1) <i class="fas fa-check-double me-2"></i>  @endif
                                    @if($order->status == 2) <i class="fas fa-times me-2"></i> @endif
                                    Status
                                </div>
                                <div class="col-7 p-2">
                                    <span>
                                        @if($order->status == 0) Pending  @endif
                                        @if($order->status == 1) Accpet @endif
                                        @if($order->status == 2) Reject  @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 p-2"><i class="fas fa-clock me-2"></i> Order Date</div>
                                <div class="col-7 p-2"><span>{{ $orderlists[0]->created_at }}</span></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <hr class="my-4"/>


            <!--START DATA TABLE -->
            <div class="table-responsive table-responsive-data2 mt-4">

                @if (count($orderlists) > 0)


                <h3 class="h3 mb-3">Order List Table</h3>

                <table class="table table-data2 text-center mt-4">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Amount</th>
                        </tr>
                    </thead>

                    <tbody id="order-container">
                        @foreach ($orderlists as $orderlist)
                            <tr class="tr-shadow">
                                <td style="vertical-align: middle">
                                    {{ $orderlist->id }}
                                </td>
                                <td >
                                    <img src="{{ asset('storage/'.$orderlist->product_img)}}" class="img_sm covers" alt=""/>
                                </td>
                                <td>{{ $orderlist->product_name }}</td>
                                <td>{{ $orderlist->qty }}</td>
                                <td>$ {{ $orderlist->total_price }}</td>
                            </tr>
                            <tr class="spacer"></tr>

                        @endforeach
                    </tbody>

                </table>


                @else

                    <div class="mt-4">
                        <h2 class="text-center ">There is no orders !</h2>
                    </div>

                @endif




            </div>
            <!-- END DATA TABLE -->

        </div>
    </div>
</div>

@endsection


@section('script')
    <script>
        $(document).ready(function(){


        });


    </script>
@endsection
