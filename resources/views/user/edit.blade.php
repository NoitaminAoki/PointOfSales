@extends('template.main')

@section('title') POS | Informasi Toko  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') Edit User @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="col-12 my-2 text-center">
					<h3 class="font-weight-bold text-uppercase">Edit User</h3>
				</div>
				<form onsubmit="return confirm('Are you sure?')" action="{{ route('user.update') }}" method="post">
					@csrf
						<div class="col-md-8 mx-auto">
							<div class="col-12 mb-2">
								<h5 class="font-weight-bold">Name</h5>
								<input type="hidden" name="_id" class="form-control" value="{{ $user->_id }}" required>
								<input type="text" name="name" class="form-control" value="{{ $user->name }}" required autocomplete="off">
							</div>
							<div class="col-12 mb-2">
								<h5 class="font-weight-bold">Email</h5>
								<input type="text" name="email" value="{{ $user->email }}" class="form-control" required>
							</div>
							<div class="col-12 mb-2">
								<h5 class="font-weight-bold">Alamat</h5>
								<textarea class="form-control" style="height: 100px;" name="alamat" required>{{ $user->alamat }}</textarea>
							</div>
							<div class="col-12 mb-2">
								<h5 class="font-weight-bold">Hak Akses</h5>
								<select name="akses" class="form-control" required>
									<option disabled>Pilih Akses</option>
									<option value="admin" {{ ($user->akses == 'admin')? 'selected' : '' }}>Admin Utama</option>
									<option value="kasir" {{ ($user->akses == 'kasir')? 'selected' : '' }}>Kasir</option>
									<option value="gudang" {{ ($user->akses == 'gudang')? 'selected' : '' }}>Admin Gudang</option>
								</select>
							</div>
							<div class="col-12">
								<button class="btn btn-primary pull-right" style="width: 120px;">Save</button>
								<a href="{{ route('informasi.index') }}" class="btn btn-secondary mr-2 pull-right" style="width: 120px;">Cancel</a>
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