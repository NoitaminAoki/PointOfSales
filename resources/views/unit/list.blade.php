@extends('template.main')

@section('title') POS | Unit  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') List Unit @endsection

@section('content')

<div class="row">
	@if (Session::has('success_message') || Session::has('failed_message'))
	<div class="col-12 message-session">
		<div class="alert alert-{{(Session::has('success_message'))? 'success' : 'danger'}} text-center">{{(Session::has('success_message'))? Session::get('success_message') : Session::get('failed_message')}}</div>
	</div>
	@endif
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="col-12">
					<a href="{{ route('unit.add') }}" class="btn btn-primary">Add New Unit</a>
				</div>
				<div class="card-title text-center">List Unit</div>
				<div class="card-subtitle text-center">lorem ipsum dolor set amet</div>
				<div class="table-responsive col-md-8 mx-auto">
					<table class="table table-bordered table-hover datatables">
						<thead>
							<tr>
								<th style="width: 50px;">No</th>
								<th>Unit</th>
								<th class="text-left">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($unit as $key => $value)
							<tr>
								<td>{{ ($key+1) }}</td>
								<td>{{ $value->Unit }}</td>
								<td style="width: 130px;" class="text-left">
									<a href="{{ route('unit.edit', ['id'=>$value->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i>Edit</a>
									<a href="{{ route('unit.delete', ['id'=>$value->id]) }}" onclick="return confirm('are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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