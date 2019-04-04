@extends('template.main')

@section('title') POS | Transaction  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') Checkout Transaction @endsection

@section('content')

<div class="row">
	@if (Session::has('success_message') || Session::has('failed_message'))
	<div class="col-12">
		<div class="alert alert-{{(Session::has('success_message'))? 'success' : 'danger'}} text-center">{{(Session::has('success_message'))? Session::get('success_message') : Session::get('failed_message')}}</div>
	</div>
	@endif
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title mb-3 text-center"><h2 class="font-weight-bold">Checkout Transaction</h2></div>
				<div class="row">
					<div class="col-md-8 mx-auto">
						<table class="w-100 table table-bordered">
							<tr>
								<td><label class="font-weight-bold text-dark">Code Transaction</label>
								</td>
								<td class="text-left">
									<label class="text-dark">{{ $header->IdTransaction  }}</label>
								</td>
								<td><label class="font-weight-bold text-dark">Date</label>
								</td>
								<td class="text-left">
									<label class="text-dark">{{ date_format(date_create($header->createdAt), "d F Y")  }}</label>
								</td>
							</tr>
							<tr>
								<td><label class="font-weight-bold text-dark">Name Employee</label>
								</td>
								<td class="text-left" colspan="3">
									<label class="text-dark">{{ $header->getUser->name  }}</label>
								</td>
							</tr>
						</table>
						<table class="w-100 table table-bordered mt-2">
							<thead>
								<tr>
									<th>No</th>
									<th>Name</th>
									<th>Qty</th>
									<th>Price (Rp.)</th>
									<th class="text-left">Sub Total (Rp.)</th>
								</tr>
							</thead>
							<tbody>
								@php
								$total = 0;
								@endphp
								@foreach ($detail as $key=>$value)
								<tr>
									@php
									$total += ($value->SubTotal);
									@endphp
									<td>{{ ($key+1) }}</td>
									<td>{{ $value->getProduct->Name }}</td>
									<td>{{ $value->Qty }}</td>
									<td>{{ number_format($value->getProduct->SellPrice, 0, ',', '.') }}</td>
									<td class="text-left">{{ number_format($value->SubTotal, 0, ',', '.') }}</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="4" class="text-right">Total Pembayaran (Rp.)</td>
									<td class="text-left">{{ number_format($total, 0, ',', '.') }}</td>
								</tr>
							</tbody>
						</table>
						<div class="col-12 mt-3 px-0">
							<form method="post" action="{{route('transaction.checkout')}}" id="form-trx">
								<div class="col-12 mt-2 px-0">
									@csrf
									<input type="hidden" name="_idHeader" value="{{ $header->_id  }}">
									<label>Nominal Pembayaran<small class="text-danger">*</small></label>
									<input type="number" class="form-control" name="nominal" id="nominal" required>
									<label class="text-danger font-weight-bold mt-1" id="label-info"></label>
								</div>
								<div class="col-12 mt-5 px-0">
									<button class="btn btn-success pull-right ml-2" style="width: 100px;">Paid</button>
									<a href="{{route('transaction.list')}}" class="btn btn-secondary pull-right ml-2">Cancel</a>
								</div>
							</form>
						</div>
					</div>
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
	$(document).on('submit', '#form-trx', function() {
		msg = confirm("Are you sure?");
		if(msg){
			return true;
		}
		return false;
	});
	$(document).on('input', '#nominal', function() {
		var input = $(this).val();
		var min = {{ $total }};
		if(!$.isNumeric(input)){
			$(this).val(input.substring(0, input.length - 1));
		}
		if(input == min){
			$('#label-info').text("");
		}
		if(input > min){
			$("#label-info").removeClass('text-danger').addClass('text-success');
			var uang = input - min;
			$("#label-info").text("Kembalian : Rp "+addCommas(uang));
		}
		if(input < min){
			$("#label-info").removeClass('text-success').addClass('text-danger');
			var uang = min - input;
			$("#label-info").text("Kurang : Rp "+addCommas(uang));
		}
	})
	function addCommas(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
</script>
@endsection