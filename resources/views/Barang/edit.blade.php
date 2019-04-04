@extends('template.main')

@section('title') POS | Barang  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') Tambah Barang @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form onsubmit="return confirm('Anda sudah yakin?')" method="post" action="{{route('barang_update')}}">
					<div class="row">
						{!! csrf_field() !!}
						<div class="col-md-12 mt-2">
							<label>Name<small class="text-danger">*</small></label>
                        <input type="hidden" class="form-control" name="id" value="{{ $barang->_id }}" required>
                        <input type="text" class="form-control" name="name" value="{{ $barang->Name }}" required>
						</div>
						<div class="col-md-6 mt-2">
						<label>Specification<small class="text-danger">*</small></label>
							<input type="text" class="form-control" name="specification" value="{{ $barang->Specification }}" required>
						</div>
						<div class="col-md-6 mt-2">
						<label>Qty<small class="text-danger">*</small></label>
							<input type="number" class="form-control" name="qty" value="{{ $barang->Qty }}" required>
						</div>
						<div class="col-md-6 mt-2">
						<label>Buy Price<small class="text-danger">*</small></label>
							<input type="number" class="form-control" name="buyPrice" value="{{ $barang->BuyPrice }}" required>
						</div>
						<div class="col-md-6 mt-2">
						<label>Sell Price<small class="text-danger">*</small></label>
							<input type="number" class="form-control" name="sellPrice" value="{{ $barang->SellPrice }}" required>
						</div>
						<div class="col-12 mt-5">
							<button class="btn btn-primary pull-right ml-2" style="width: 100px;">Simpan</button>
							<a href="{{route('barang_list')}}" class="btn btn-secondary pull-right ml-2">Batal</a>
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