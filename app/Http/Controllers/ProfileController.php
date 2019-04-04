<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile as Profile;
use Session;

class ProfileController extends Controller
{
    public function index()
    {
    	$data['profile'] = Profile::first();
    	return view('informasi.toko')->with($data);
    }

    public function add()
    {
    	return view('informasi.toko-add');
    }

    public function save(Request $r)
    {
        $file = $r->img;
        $file->move('/img/',$file->getClientOriginalName());
    	$table = new Profile;
    	$table->NamaKoperasi = $r->input('NamaKoperasi');
    	$table->Telp = $r->input('Telp');
    	$table->KodePos = $r->input('KodePos');
    	$table->Deskripsi = $r->input('Deskripsi');
        $table->Img = $file->getClientOriginalName();
    	$table->Alamat = $r->input('Alamat');
    	$affected = $table->save();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Creating Profile');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Creating Profile');
    	}

    	return redirect()->route('informasi.index');
    }

    public function edit($id)
    {
    	$data['profile'] = Profile::find($id);
    	return view('informasi.toko-edit')->with($data);
    }

    public function update(Request $r)
    {
        $file = $r->img;
        $file->move(public_path().'/img/',$file->getClientOriginalName());
    	$table = Profile::find($r->input('_id'));
    	$table->NamaKoperasi = $r->input('NamaKoperasi');
    	$table->Telp = $r->input('Telp');
    	$table->KodePos = $r->input('KodePos');
    	$table->Deskripsi = $r->input('Deskripsi');
        $table->Img = $file->getClientOriginalName();
    	$table->Alamat = $r->input('Alamat');
    	$affected = $table->update();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Changing Profile');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Changing Profile');
    	}

    	return redirect()->route('informasi.index');
    }
}
