@extends('template.main')

@section('title') POS | Informasi Toko  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') Ubah Informasi Toko @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="col-12 my-2 text-center">
					<h3 class="font-weight-bold text-uppercase">Informasi Toko</h3>
				</div>
				<form onsubmit="return confirm('Are you sure?')" action="{{ route('informasi.update') }}" method="post" enctype="multipart/form-data">
					@csrf
				<div class="row">
					<div class="col-md-6">
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Nama Instansi</h5>
							<input type="hidden" name="_id" class="form-control" value="{{ $profile->_id }}" required>
							<input type="text" name="NamaKoperasi" class="form-control" value="{{ $profile->NamaKoperasi }}" required autocomplete="off">
						</div>
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Telp</h5>
							<input type="text" name="Telp" value="{{ $profile->Telp }}" class="form-control" required>
						</div>
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Kode Pos</h5>
							<input type="text" name="KodePos" value="{{ $profile->KodePos }}" class="form-control" required>
						</div>
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Deskripsi</h5>
							<textarea class="form-control" style="height: 100px;" name="Deskripsi" required>{{ $profile->Deskripsi }}</textarea>
						</div>
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Alamat</h5>
							<textarea class="form-control" style="height: 100px;" name="Alamat" required>{{ $profile->Alamat }}</textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card" style="width: 18rem;">
							<label>Image</label>
							<input type="file" class="form-control" name="img">
						</div>
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