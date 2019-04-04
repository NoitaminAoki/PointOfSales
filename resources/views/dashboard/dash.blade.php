@extends('template.main')

@section('title') POS | Dashboard  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') Dashboard @endsection

@section('content')

<div class="row">
    @if (Session::has('success_message') || Session::has('failed_message'))
    <div class="col-12 message-session">
        <div class="alert alert-{{(Session::has('success_message'))? 'success' : 'danger'}} text-center">{{(Session::has('success_message'))? Session::get('success_message') : Session::get('failed_message')}}</div>
    </div>
    @endif
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-block">
                <h4 class="card-title">Paid Transaction</h4>
                <h2><i class="fa fa-shopping-bag fa-3x"></i></h2>
            </div>
            <div class="row px-2 no-gutters">
                <div class="col-12">
                    <h3 class="card card-block border-top-0 border-left-0 border-bottom-0">{{ $paidTrx }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-block">
                <h4 class="card-title">Unpaid Transaction</h4>
                <h2><i class="fa fa-shopping-cart fa-3x"></i></h2>
            </div>
            <div class="row px-2 no-gutters">
                <div class="col-12">
                    <h3 class="card card-block border-top-0 border-left-0 border-bottom-0">{{ $unpaidTrx }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-block">
                <h4 class="card-title">Product</h4>
                <h2><i class="fa fa-archive fa-3x"></i></h2>
            </div>
            <div class="row px-2 no-gutters">
                <div class="col-12">
                    <h3 class="card card-block border-top-0 border-left-0 border-bottom-0">{{ $product }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script src="{{asset('templates/js/lib/toastr/toastr.min.js')}}"></script>
<script src="{{asset('templates/js/custom/toastr.custom.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.datatables').dataTable();
        $('.message-session').delay(3000).slideUp(600);
    });
</script>
@endsection