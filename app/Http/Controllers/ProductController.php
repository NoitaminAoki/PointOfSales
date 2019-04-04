<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use App\Kategori as Kategori;
use App\Unit as Unit;
use Session;
use PDF;

class ProductController extends Controller
{
    public function list()
    {
    	$data['product'] = Product::all();
    	return view('product.listing')->with($data);
    }
    public function add()
    {
		$data['kategori'] = Kategori::all();
		$data['unit'] = Unit::all();
    	return view('product.add')->with($data);
    }

    public function save(Request $r)
    {
    	$table = new Product;
    	$table->Name = $r->input('name');
    	$table->Specification = $r->input('specification');
    	$table->Qty = (int)$r->input('qty');
    	$table->Kategori = $r->input('kategori');
    	$table->Unit = $r->input('unit');
    	$table->BuyPrice = (int)$r->input('buyPrice');
    	$table->SellPrice = (int)$r->input('sellPrice');
    	$affected = $table->save();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Adding Product');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Adding Product');
    	}

    	return redirect()->route('product.list');
    }

    public function edit($id)
    {
    	$data['product'] = Product::find($id);
		$data['kategori'] = Kategori::all();
		$data['unit'] = Unit::all();
    	return view('product.edit')->with($data);
    }

    public function update(Request $r)
    {
    	$table = Product::find($r->input('_id'));
    	$table->Name = $r->input('name');
    	$table->Specification = $r->input('specification');
    	$table->Qty = ((int)$r->input('qty'));
    	$table->Kategori = $r->input('kategori');
    	$table->Unit = $r->input('unit');
    	$table->BuyPrice = (int)$r->input('buyPrice');
    	$table->SellPrice = (int)$r->input('sellPrice');
    	$affected = $table->save();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Updating Product');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Updating Product');
    	}

    	return redirect()->route('product.list');
    }

    public function delete(Request $r,$id)
    {
    	$affected = Product::find($id)->delete();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Deleting Product');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Deleting Product');
    	}

    	return redirect()->route('product.list');
	}
		
	public function get($id)
	{
		$data = Product::findOrfail($id);
		return response()->json($data);
	}

    public function report()
    {
        $data['product'] = Product::all();
        $pdf = PDF::loadView('report.product', $data);
        return $pdf->download('product-invoice.pdf');
    }
}
