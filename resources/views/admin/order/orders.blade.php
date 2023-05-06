@extends('admin.layouts.master')


@section('title','Orders Page')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">


            <div>
                <h1 class="">Orders</h1>
            </div>


            <!--START DATA TABLE -->
            <div class="table-responsive table-responsive-data2 mt-4">


                @if (session('updated'))
                    <div class="w-75 alert alert-warning alert-dismissible fade show ms-auto">
                        <strong>{{ session('updated') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
                    </div>
                @endif


                <div class="d-flex justify-content-between align-items-center">
                    <form action="{{ route('order#statusFilter') }}" method="get" class="w-50">
                        @csrf
                        <div class="w-50 input-group">
                            <select name="statusfilter" id="statusfilter" class="form-select">
                                <option value="" @if(request('statusfilter') == "") selected @endif>All</option>
                                <option value="0" @if(request('statusfilter') == "0") selected @endif>Pending</option>
                                <option value="1" @if(request('statusfilter') == "1") selected @endif>Accpet</option>
                                <option value="2" @if(request('statusfilter') == "2") selected @endif>Reject</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="bg-dark text-light input-group-text"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class=' bg-white px-3 py-2'>
                        <h4><i class="fas fa-database"></i> - {{ count($orders)}}</h4>
                    </div>
                </div>

                @if (count($orders) > 0)

                <table class="table table-data2 text-center mt-4">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User Name</th>
                            <th>Order Date</th>
                            <th>Order Code</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody id="order-container">
                        @foreach ($orders as $order)
                            <tr class="tr-shadow">
                                <td style="vertical-align: middle">{{ $order->id}}</td>
                                <td>{{ $order->username }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td class="ordercode">
                                    <a href="{{ route('order#listInto',$order->order_code) }}" class="btn btn-primary">{{ $order->order_code}}</a>
                                </td>
                                <td>{{ $order->total_price }}</td>
                                <td>
                                    <select name="status" class="form-select status">
                                        <option value="0" @if($order->status == 0) selected @endif>Pending</option>
                                        <option value="1"  @if($order->status == 1) selected @endif>Accept</option>
                                        <option value="2"  @if($order->status == 2) selected @endif>Reject</option>
                                    </select>
                                </td>
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

            // $('#pending').click(function(){
            //     let status = 0;
            //     forajax(status);
            // });

            // $('#accept').click(function(){
            //     let status = 1;
            //     forajax(status);
            // });

            // $('#reject').click(function(){
            //     let status = 2;
            //     forajax(status);
            // });

            // $('#all').click(function(){
            //     let status = '';
            //     forajax(status);
            // });

            // start ajax function
            // function forajax(status){
            //     $.ajax({
            //         type : 'get',
            //         url : 'http://localhost:8000/ajax/order/status/filter',
            //         data : {'status' : status},
            //         dataType : 'json',
            //         success : function(response){
            //             let lists = '';

            //             let months = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];

            //             // start if
            //             if(response.length > 0){

            //                 // start for loop
            //                 for(let i = 0; i < response.length; i++){
            //                     let date = new Date(response[i].created_at);

            //                     let month = date.getMonth();
            //                     let message = response[i].status;

            //                     let pending = message == 0 ? 'selected' : '';
            //                     let accept = message == 1 ? 'selected' : '';
            //                     let reject = message == 2 ? 'selected' : '';


            //                     let getday = date.getDate();
            //                     let getmonth = months[month];
            //                     let getyear = date.getUTCFullYear();

            //                     let finalDate = getday+ '-' + getmonth + '-' + getyear;

            //                     lists += `
            //                         <tr class="tr-shadow">
            //                             <td style="vertical-align: middle">${response[i].id}</td>
            //                             <td>${response[i].username}</td>
            //                             <td>${finalDate}</td>
            //                             <td>${response[i].order_code}</td>
            //                             <td>${response[i].total_price}</td>
            //                             <td>
            //                                 <select name="status"  class="form-select status">
            //                                     <option value="0" ${pending}>Pending</option>
            //                                     <option value="1" ${accept}>Accept</option>
            //                                     <option value="2" ${reject}>Reject</option>
            //                                 </select>
            //                             </td>
            //                         </tr>
            //                         <tr class="spacer"></tr>
            //                     `;

            //                 }

            //                 // end for loop

            //                 $('#order-container').html(lists);

            //             }else{
            //                 $('#order-container').html(`<tr>
            //                     <td colspan="6"><h2 class="">There is no orders !</h2></td>
            //                 </tr>`);
            //             }

            //             // end if

            //         }

            //         // end success function

            //     });

            //     // end ajax

            // }
            // end ajax function

            function changestatus(data){
                $.ajax({
                    type : 'get',
                    url : '/ajax/order/status/change',
                    data : data,
                    dataType : 'json',
                    success : function(response){
                        console.log(response);
                    }
                })
            }


            $(document).on('change', '.status', function() {
                const status = $(this).val();
                const order_code = $(this).parents('tr').find('.ordercode').text();
                let data = {
                    'status' : status,
                    'order_code' : order_code
                }
                changestatus(data);
            });




        });


    </script>
@endsection
