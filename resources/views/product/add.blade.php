@extends('template.main')

@section('title') POS | Product  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('plugins/select2/select2.css')}}">
@endsection

@section ('body_title') Add Product @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="col-12 my-2 text-center">
					<h3 class="font-weight-bold text-uppercase">Add New Product</h3>
				</div>
				<form onsubmit="return confirm('Are you sure?')" method="post" action="{{route('product.save')}}">
					<div class="col-md-8 mx-auto">
						{!! csrf_field() !!}
						<div class="col-12 mt-2">
							<label>Name<small class="text-danger">*</small></label>
							<input type="text" class="form-control" name="name" required autocomplete="off">
						</div>
						<div class="col-12 mt-2">
							<label>Specification<small class="text-danger">*</small></label>
							<input type="text" class="form-control" name="specification" required>
						</div>
						<div class="col-12 mt-2">
							<label>Qty<small class="text-danger">*</small></label>
							<input type="number" class="form-control" name="qty" required>
						</div>
						<div class="col-12 mt-2">
							<label>Kategori<small class="text-danger">*</small></label>
							<select name="kategori" class="form-control select2" required>
								<option disabled selected>Choose Category</option>
								@foreach ($kategori as $item)
								<option value="{{ $item->_id }}">{{ $item->Kategori }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-12 mt-2">
							<label>Unit<small class="text-danger">*</small></label>
							<select name="unit" class="form-control select2" required>
								<option disabled selected>Choose Unit</option>
								@foreach ($unit as $item)
								<option value="{{ $item->_id }}">{{ $item->Unit }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-12 mt-2">
							<label>Buy Price<small class="text-danger">*</small></label>
							<input type="number" class="form-control" name="buyPrice" required>
						</div>
						<div class="col-12 mt-2">
							<label>Sell Price<small class="text-danger">*</small></label>
							<input type="number" class="form-control" name="sellPrice" required>
						</div>
						<div class="col-12 mt-5">
							<button class="btn btn-primary pull-right ml-2" style="width: 100px;">Save</button>
							<a href="{{route('product.list')}}" class="btn btn-secondary pull-right ml-2">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footer')
<script src="{{asset('templates/js/lib/toastr/toastr.min.js')}}"></script>
<script src="{{asset('templates/js/custom/toastr.custom.js')}}"></script>
<script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
<script>
	$(document).ready(function(){
		$('.select2').select2();
	});
</script>

@endsection