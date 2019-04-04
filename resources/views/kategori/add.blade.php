@extends('template.main')

@section('title') POS | Category  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') Add Category @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="col-12 my-2 text-center">
					<h3 class="font-weight-bold text-uppercase">Add New Category</h3>
				</div>
				<form onsubmit="return confirm('Are you sure?')" method="post" action="{{route('kategori.save')}}">
					<div class="col-md-8 mx-auto">
						{!! csrf_field() !!}
						<div class="col-12 mt-2">
							<label>Category<small class="text-danger">*</small></label>
							<input type="text" class="form-control" name="Kategori" required autocomplete="off">
						</div>
						<div class="col-12 mt-5">
							<button class="btn btn-primary pull-right ml-2" style="width: 100px;">Save</button>
							<a href="{{route('kategori.list')}}" class="btn btn-secondary pull-right ml-2">Cancel</a>
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

@endsection