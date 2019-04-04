<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit as Unit;
use Session;

class UnitController extends Controller
{
	public function list()
    {
    	$data['unit'] = Unit::all();
    	return view('unit.list')->with($data);
    }

    public function add()
    {
    	return view('unit.add');
    }

    public function save(Request $r)
    {
    	$table = new Unit;
    	$table->Unit = $r->input('Unit');
    	$affected = $table->save();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Adding Unit');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Adding Unit');
    	}

    	return redirect()->route('unit.list');
    }

    public function edit($id)
    {
    	$data['unit'] = Unit::find($id);
    	return view('unit.edit')->with($data);
    }

    public function update(Request $r)
    {
    	$table = Unit::find($r->input('_id'));
    	$table->Unit = $r->input('Unit');
    	$affected = $table->save();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Updating Unit');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Updating Unit');
    	}

    	return redirect()->route('unit.list');
    }

    public function delete(Request $r,$id)
    {
    	$affected = Unit::find($id)->delete();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Deleting Unit');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Deleting Unit');
    	}

    	return redirect()->route('unit.list');
    }
}
