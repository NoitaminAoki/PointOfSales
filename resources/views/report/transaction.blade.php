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
	<div class="card-title mb-3 text-center"><h2 class="font-weight-bold">Report Transaction</h2></div>
	<div class="row">
		<div class="col-md-8 mx-auto">
			<table class="w-100 table table-bordered">
				<tr>
					<td><label class="font-weight-bold text-dark">Code Transaction</label>
					</td>
					<td class="text-left">
						<label class="text-dark">{{ $header->IdTransaction  }}</label>
					</td>
					<td><label class="font-weight-bold text-dark">Date</label>
					</td>
					<td class="text-left">
						<label class="text-dark">{{ date_format(date_create($header->createdAt), "d F Y")  }}</label>
					</td>
				</tr>
				<tr>
					<td><label class="font-weight-bold text-dark">Name Employee</label>
					</td>
					<td class="text-left" colspan="3">
						<label class="text-dark">{{ $header->getUser->name  }}</label>
					</td>
				</tr>
				<tr>
					<td><label class="font-weight-bold text-dark">Payment Nominal (Rp.)</label>
					</td>
					<td class="text-left" colspan="3">
						<label class="text-dark">{{ number_format($report->Nominal, 0, ',', '.') }}</label>
					</td>
				</tr>
				<tr>
					<td><label class="font-weight-bold text-dark">Change (Rp.)</label>
					</td>
					<td class="text-left" colspan="3">
						<label class="text-dark">{{ number_format($report->Kembalian, 0, ',', '.') }}</label>
					</td>
				</tr>
			</table>
			<table class="w-100 table table-bordered mt-2">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Qty</th>
						<th>Price (Rp.)</th>
						<th class="text-left">Sub Total (Rp.)</th>
					</tr>
				</thead>
				<tbody>
					@php
					$total = 0;
					@endphp
					@foreach ($detail as $key=>$value)
					<tr>
						@php
						$total += ($value->SubTotal);
						@endphp
						<td class="text-dark">{{ ($key+1) }}</td>
						<td class="text-dark">{{ $value->getProduct->Name }}</td>
						<td class="text-dark">{{ $value->Qty }}</td>
						<td class="text-dark">{{ number_format($value->getProduct->SellPrice, 0, ',', '.') }}</td>
						<td class="text-left text-dark">{{ number_format($value->SubTotal, 0, ',', '.') }}</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="4" class="text-right text-dark">Total (Rp.)</td>
						<td class="text-left text-dark">{{ number_format($total, 0, ',', '.') }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>