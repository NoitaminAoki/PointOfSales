@extends('template.main')

@section('title') POS | Informasi Toko  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') Informasi Toko @endsection

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
				<div class="col-12 my-2 text-center">
					<h3 class="font-weight-bold text-uppercase">Informasi Toko</h3>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Nama Instansi</h5>
							<label>{{ (!empty($profile))? $profile->NamaKoperasi : 'Belum ada'  }}</label>
						</div>
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Telp</h5>
							<label>{{ (!empty($profile))? $profile->Telp : 'Belum ada'  }}</label>
						</div>
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Kode Pos</h5>
							<label>{{ (!empty($profile))? $profile->KodePos : 'Belum ada'  }}</label>
						</div>
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Deskripsi</h5>
							<p class="text-dark">{{ (!empty($profile))? $profile->Deskripsi : 'Belum ada'  }}</p>
						</div>
						<div class="col-12 mb-2">
							<h5 class="font-weight-bold">Alamat</h5>
							<p class="text-dark">{{ (!empty($profile))? $profile->Alamat : 'Belum ada'  }}</p>
						</div>
						<div class="col-12">
							@if (empty($profile))
							<a href="{{ route('informasi.add') }}" class="btn btn-primary pull-right" style="width: 100px;">Buat</a>
							@else
							<a href="{{ route('informasi.edit', ['id' => $profile->_id]) }}" class="btn btn-warning pull-right" style="width: 100px;">Ubah</a>
							@endif
						</div>
					</div>
					<div class="col-md-6">
						<div class="card" style="width: 18rem;">
							<img class="card-img-top" src="{{ (!empty($profile) && !empty($profile->Img))? asset('img/'.$profile->Img) : asset('img/media-pict-camera.png') }}" alt="Card image cap" style="width: 200px; height: 200px;">
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

	@endsection