@extends('template.main')

@section('title') POS | Transaction  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') List Transaction @endsection

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
				<div class="card-title text-center">List Transaction</div>
				<div class="card-subtitle text-center">lorem ipsum dolor set amet</div>
				<div class="table-responsive">
					<table class="table table-bordered table-hover datatables">
						<thead>
							<tr>
								<th>No</th>
								<th>ID Transaction</th>
								<th>Name Employee</th>
								<th>Status</th>
								<th>Transaction Date</th>
								<th class="text-left">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($transaction as $key => $value)
							<tr>
								<td>{{ ($key+1) }}</td>
								<td>{{ $value->IdTransaction }}</td>
								<td>{{ $value->getUser->name }}</td>
								<td>@if ($value->Status == "Paid")
									<label class="text-success">{{ $value->Status }}</label>
									@else
									<label class="text-danger">{{ $value->Status }}</label>
								@endif</td>
								<td>{{ date_format(date_create($value->CreatedAt), "d F Y") }}</td>
								<td style="width: 180px;" class="text-left">
									@if ($value->Status != "Paid")
									<a href="{{ route('transaction.paid', ['id'=>$value->id]) }}" class="btn btn-success">Paid</a>
									<a href="{{ route('transaction.delete', ['id'=>$value->id]) }}" onclick="return confirm('are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
									@else
									@endif
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