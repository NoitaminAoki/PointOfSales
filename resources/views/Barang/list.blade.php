@extends('template.main')

@section('title') POS | Barang  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') List Barang @endsection

@section('content')

<div class="row">
	@if (Session::has('success_message') || Session::has('failed_message'))
	<div class="col-12">
		<div class="message-session alert alert-{{(Session::has('success_message'))? 'success' : 'danger'}} text-center">{{(Session::has('success_message'))? Session::get('success_message') : Session::get('failed_message')}}</div>
	</div>
	@endif
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title text-center">List Barang</div>
				<div class="card-subtitle text-center">lorem ipsum dolor set amet</div>
				<div class="table-responsive">
					<table class="table table-bordered table-hover datatables">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Specification</th>
								<th>Qty</th>
								<th>Buy Price</th>
								<th>Sell Price</th>
								<th>Profit</th>
								<th class="text-left">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($barang as $key => $value)
							<tr>
								<td>{{ ($key+1) }}</td>
								<td>{{ $value->Name }}</td>
								<td>{{ $value->Specification }}</td>
								<td>{{ $value->Qty }}</td>
								<td>{{ number_format($value->BuyPrice, 0, ",", ".") }}</td>
								<td>{{ number_format($value->SellPrice, 0, ",", ".") }}</td>
								<td>{{ number_format(($value->SellPrice-$value->BuyPrice), 0, ",", ".") }}</td>
								<td style="width: 180px;">
									<a href="{{ route('barang_edit', ['id'=>$value->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i>Edit</a>
									<a href="{{ route('barang_delete', ['id'=>$value->id]) }}" onclick="return confirm('are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
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