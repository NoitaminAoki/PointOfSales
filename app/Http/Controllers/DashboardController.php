<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use App\HeaderTransaction as HeaderTransaction;
use App\DetailTransaction as DetailTransaction;

class DashboardController extends Controller
{
	public function index()
	{
		$data['product'] = Product::count();
		$data['paidTrx'] = HeaderTransaction::where('Status', 'Paid')->count();
		$data['unpaidTrx'] = HeaderTransaction::where('Status', 'Unpaid')->count();
		return view('dashboard.dash')->with($data);
	}
}
