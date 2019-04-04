<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;

class UserController extends Controller
{
    public function list()
    {
    	$data['user'] = User::all();
    	return view('user.list')->with($data);
    }
    public function edit($id)
    {
    	$data['user'] = User::find($id);
    	return view('user.edit')->with($data);
    }

    public function update(Request $r)
    {
    	$table = User::find($r->input('_id'));
    	$table->name = $r->input('name');
    	$table->email = $r->input('email');
    	$table->alamat = $r->input('alamat');
    	$table->akses = $r->input('akses');
    	$affected = $table->update();
    	if($affected > 0){
    		$r->session()->flash('success_message', 'Success Updating User');
    	}else{
    		$r->session()->flash('failed_message', 'Failed Updating User');
    	}

    	return redirect()->route('user.list');
    }
}
