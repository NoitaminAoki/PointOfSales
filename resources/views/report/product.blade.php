<!DOCTYPE html>
<html>
<head>
	<title>Report Transaction</title>
	<!-- Bootstrap Core CSS -->
	<link href="./templates/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	{{-- <link href="{{asset('templates/css/helper.css')}}" rel="stylesheet">
	<link href="{{asset('templates/css/style.css')}}" rel="stylesheet"> --}}
</head>
<body>
	<div class="card-title mb-3 text-center"><h2 class="font-weight-bold">Report Product</h2></div>
	<div class="row">
		<div class="col-md-8 mx-auto">
			<table class="table table-bordered table-hover datatables">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Specification</th>
						<th>Qty</th>
						<th>Category</th>
						<th>Unit</th>
						<th>Buy Price</th>
						<th>Sell Price</th>
						<th class="text-left">Profit</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($product as $key => $value)
					<tr>
						<td>{{ ($key+1) }}</td>
						<td>{{ $value->Name }}</td>
						<td>{{ $value->Specification }}</td>
						<td>{{ $value->Qty }}</td>
						<td>{{ $value->getKategori->Kategori }}</td>
						<td>{{ $value->getUnit->Unit }}</td>
						<td>{{ number_format($value->BuyPrice, 0, ",", ".") }}</td>
						<td>{{ number_format($value->SellPrice, 0, ",", ".") }}</td>
						<td class="text-left">{{ number_format(($value->SellPrice-$value->BuyPrice), 0, ",", ".") }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>