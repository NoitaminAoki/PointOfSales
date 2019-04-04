<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book as Book;

class BookController extends Controller
{
	public function index()
	{
		// $pdf = PDF::loadView('pdf.invoice', $data);
		// return $pdf->download('invoice.pdf');
	}
}
