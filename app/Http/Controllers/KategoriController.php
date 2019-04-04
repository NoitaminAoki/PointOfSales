<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori as Kategori;
use Session;

class KategoriController extends Controller
{
	public function list()
    {
    	$data['kategori'] = Kategori::all();
    	return view('kategori.list')->with($data);
    }

    public function add()
    {
    	return view('kategori.add');
    }

    public function save(Request $r)
    {
    	$table = new Kategori;
    	$table->Kategori = $r->input('Kategori');
    	$affected = $table->save();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Adding Kategori');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Adding Kategori');
    	}

    	return redirect()->route('kategori.list');
    }

    public function edit($id)
    {
    	$data['kategori'] = Kategori::find($id);
    	return view('kategori.edit')->with($data);
    }

    public function update(Request $r)
    {
    	$table = Kategori::find($r->input('_id'));
    	$table->Kategori = $r->input('Kategori');
    	$affected = $table->save();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Updating Kategori');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Updating Kategori');
    	}

    	return redirect()->route('kategori.list');
    }

    public function delete(Request $r,$id)
    {
    	$affected = Kategori::find($id)->delete();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Deleting Kategori');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Deleting Kategori');
    	}

    	return redirect()->route('kategori.list');
    }
}
