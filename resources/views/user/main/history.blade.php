@extends('user.layouts.master')


@section('title','History Page')



@section('content')

 <!-- Cart Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">

        <div class="col-lg-8 table-responsive mx-auto">

            <a href="{{ route('user#homePage') }}" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left me-2"></i> Back</a>

            @if (count($lists) > 0)
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody class="align-middle" id="data-containers">
                        @foreach ($lists as $list)
                            <tr>
                                <td class="align-middle">{{ $list->created_at->format('M-d-Y h:i:s a') }}</td>
                                <td class="align-middle">{{ $list->order_code }}</td>
                                <td class="align-middle">{{ $list->total_price }}</td>
                                <td class="align-middle">
                                    @if ($list->status == 0)
                                        <span class="text-info">Pending</span>
                                    @endif
                                    @if ($list->status == 1)
                                        <span class="text-success">Accept</span>
                                    @endif
                                    @if ($list->status == 2)
                                        <span class="text-danger">Reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{$lists->links()}}
                </div>
            @else
                <div class="mt-4">
                    <h2 class="text-center ">There is no pizzas !</h2>
                </div>
            @endif
        </div>

    </div>
</div>
<!-- Cart End -->

@endsection



@section('ajax')
@endsection

