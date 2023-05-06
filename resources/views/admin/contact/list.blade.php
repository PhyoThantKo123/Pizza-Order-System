@extends('admin.layouts.master')


@section('title','Contact List Page')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-md-8 mx-auto">

                <h1 class="text-center mb-4">Contact List</h1>

                @if (count($contacts) > 0)

                    <div class="text-end mb-3">
                        <div class='d-inline-block bg-white p-1 px-3 '>
                            <h4><i class="fas fa-database"></i> - <span id="count">{{ count($contacts) }}</span></h4>
                        </div>
                    </div>

                    @foreach ($contacts as $contact)
                        <div class="card position-relative mb-3">
                            <div class="card-body">
                                <h3 class="mb-2 font-monospace"><i class="fas fa-user me-1"></i> Name : {{ $contact->name }}</h3>
                                <p class="text-info mb-3"><i class="fas fa-envelope-open-text me-3"></i> Email : {{ $contact->email }}</p>
                                <div class="mb-4">
                                    <p @if(Str::length($contact->message) >= 100 )  style="text-indent:50px" @endif>{{ $contact->message }}</p>
                                </div>
                                <p class="text-end"><i class="fas fa-clock"></i> {{ $contact->created_at->format('Y-M-d h:i:s a') }} </p>
                            </div>
                            <a href="javascript:void(0)" idx="{{$contact->id}}" class="text-decoration-none text-danger position-absolute top-0 end-0 fs-3 me-3 btn-times">&times;</a>
                        </div>
                    @endforeach

                    <div class="mt-5">
                        {{$contacts->links()}}
                    </div>

                @else
                    <h2 class="text-secondary text-center mt-5">There is no contact here !</h2>
                @endif


            </div>

        </div>
    </div>
</div>

@endsection


@section('script')
    <script>
        $('.btn-times').click(function(){
            let id = $(this).attr('idx');
            $.ajax({
                type : 'get',
                url : '/ajax/contact/delete',
                data : {'id' : id},
                dataType : 'json',
                success : function (response){
                    console.log(response);
                }
            });
            $(this).parents('.card').remove();
            $count = $('#count').text();
            $count = Number($count) - 1;
            $('#count').text($count);
        });
    </script>
@endsection
