@extends('template.main')

@section('title') POS | Transaction  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('plugins/select2/select2.css')}}">
@endsection

@section ('body_title') Add Transaction @endsection

@section('content')

<form onsubmit="return confirm('Are you sure?')" method="post" action="{{route('transaction.save')}}">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="col-12 mt-5">
                            <table>
                                <tr>
                                    <td><h4>No Transaction</h4></td>
                                    <td class="pl-3 pr-1"><h4> : </h4></td>
                                    <td><h4>{{$kodeTransaction}}</h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Name Employee</h4></td>
                                    <td class="pl-3 pr-1"><h4> : </h4></td>
                                    <td class="text-left"><h4>{{ Auth::user()->name }}</h4></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 text-center"><h4 class="mt-2">My Cart</h4></div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="table-cart">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <button class="btn btn-primary pull-right ml-2" style="width: 100px;">Simpan</button>
                        <a href="{{route('transaction.list')}}" class="btn btn-secondary pull-right ml-2">Batal</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12"></div>
                        <div class="col-12">
                            <div class="col-12 text-center mt-5 border"><h4 class="mt-2">Product</h4></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover datatables">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Specification</th>
                                            <th>Category</th>
                                            <th>Unit</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th class="text-left">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $key => $value)
                                        <tr>
                                            <td>{{ $value->Name }}</td>
                                            <td>{{ $value->Specification }}</td>
                                            <td>{{ $value->getKategori->Kategori }}</td>
                                            <td>{{ $value->getUnit->Unit }}</td>
                                            <td style="width: 25px;">{{ $value->Qty }}</td>
                                            <td>{{ number_format($value->SellPrice, 0, ",", ".") }}</td>
                                            <td class="text-center" style="width: 25px;"><button type="button" data-id="{{$value->_id}}" class="btn btn-sm btn-success btn-add-cart" id="btn{{ $value->_id }}"><i class="fa fa-plus"></i></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer')
<script src="{{asset('templates/js/lib/toastr/toastr.min.js')}}"></script>
<script src="{{asset('templates/js/custom/toastr.custom.js')}}"></script>
<script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
<script src="{{ asset('js/handlebars-v4.0.12.js') }}"></script>
<script id="template-cart" type="text/x-handlebars-template">
    <tr>
        <td><input type="hidden" name="_id[]" value="@{{_id}}">@{{ name }}</td>
        <td style="width:150px;">
            <div class="input-group">
                <input type="number" name="qty[]" data-max="@{{max}}" class="input-qty form-control" value="@{{qty}}">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">/@{{ max }}</span>
                </div>
            </div>
        </td>
        <td class="price" style="width:150px;">@{{ price }}</td>
        <td class="total" style="width:150px;">@{{ total }}</td>
        <td class="text-center" style="width:100px;"><button type="button" class="btn btn-sm btn-danger btn-remove-cart"><i class="fa fa-trash"></i></button></td>
    </tr>
</script>
<script>
    $(document).ready(function() {
        $('.datatables').dataTable();
        $('.message-session').delay(3000).slideUp(600);
    });
    $('.btn-add-cart').on('click', function(){
        var _id = $(this).data('id');
        var routes = "{{ route('product.get') }}";
        var csrf_token = "{{ csrf_token() }}";
        $.ajax({
            url: routes+'/'+_id,
            type: "GET",
            success: function(result) {
                var data = {
                    '_id' : result._id,
                    'name' : result.Name,
                    'max' : result.Qty,
                    'qty' : 1,
                    'price' : result.SellPrice,
                    'total' : result.SellPrice
                };
                var temp = Handlebars.compile($("#template-cart").html());
                var getHtml = temp(data);
                $('#table-cart tbody').append(getHtml);
            },
            error: function(xhr, status, message) {
                alert('error');
            }
        });
    });
    $(document).on('input', '.input-qty', function() {
        var input = $(this).val();
        var max = $(this).data('max');
        if(!$.isNumeric(input)){
            $(this).val(input.substring(0, input.length - 1));
        }
        if(input > max){
            $(this).val(max);
            input = max;
        }
        if(input <= 0){
            $(this).val(1);
            input = 1;
        }
        var price = $(this).closest('tr').find('.price').text();
        var total = $(this).closest('tr').find('.total');
        total.text(input*price);
    });
    $(document).on('click', '.btn-remove-cart', function() {
        var msg = confirm("Are you sure?");
        if(msg){
            $(this).closest('tr').remove();
        }
    });
</script>
@endsection