<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HeaderTransaction as HeaderTransaction;
use App\DetailTransaction as DetailTransaction;
use App\ReportTransaction as ReportTransaction;
use App\Product as Product;
use Auth;
use PDF;

class TransactionController extends Controller
{
	public function list()
	{
		$data['transaction'] = HeaderTransaction::orderBy('Status', 'asc')->get();
		return view('transaction.list')->with($data);
	}

	public function add()
	{
		$data['product'] = Product::where('Qty', '>=', 1)->get();
		$generateCode = "TRX".date("Y").sprintf('%06d', (HeaderTransaction::count()+1));
		$data['kodeTransaction'] = $generateCode;
        // dd($data);
		return view('Transaction.add')->with($data);
	}

	public function paid($id)
	{
		$data['header'] = HeaderTransaction::find($id);
		$data['detail'] = DetailTransaction::where('HeaderId',$id)->get();
		return view('transaction.checkout')->with($data);
	}

	public function save(Request $r)
	{
		$generateCode = "TRX".date("Y").sprintf('%06d', (HeaderTransaction::count()+1));
		$employeeId = Auth::id();
        //dd($r->input());
		$table = new HeaderTransaction;
		$table->IdTransaction = $generateCode;
		$table->UserId = $employeeId;
		$table->Status = "Unpaid";
		$table->save();
		foreach ($r->input('_id') as $key => $value) {
			$product = Product::find($value);
			$detailTrx = new DetailTransaction;
			$detailTrx->HeaderId = $table->_id;
			$detailTrx->ProductId = $value;
			$detailTrx->Qty = (int)$r->input('qty')[$key];
			$detailTrx->SubTotal = (int)($detailTrx->Qty*$product->SellPrice);
			$detailTrx->save();
			$product->Qty -= (int)$r->input('qty')[$key];
			$product->save();
		}
		$r->session()->flash('success_message', 'Success Adding Transaction');

		return redirect()->route('transaction.paid', $table->_id);
	}

	public function delete(Request $r,$id)
	{
		$affected = HeaderTransaction::find($id)->delete();
		if($affected > 0){
			$r->session()->flash('success_message', 'Success Deleting Transaction');
		}else{
			$r->session()->flash('failed_message', 'Failed Deleting Transaction');
		}

		return redirect()->route('transaction.list');
	}

	public function checkout(Request $r)
	{
		$trx = HeaderTransaction::find($r->input('_idHeader'));
		$getPrice = DetailTransaction::where('HeaderId', $trx->_id)->sum('SubTotal');
		$table = new ReportTransaction;
		$table->HeaderId = $trx->_id;
		$table->EmployeeId = Auth::id();
		$table->Nominal = $r->input('nominal');
		$table->Kembalian = ($r->input('nominal') - $getPrice);
		$table->save();
		$trx->Status = "Paid";
		$trx->update();
		$data['header'] = $trx;
		$data['detail'] = DetailTransaction::where('HeaderId',$trx->_id)->get();
		$data['report'] = $table;
		$pdf = PDF::loadView('report.transaction', $data);
		return $pdf->stream();

	}
}
