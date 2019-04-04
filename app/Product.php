<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'product';

	public function getKategori()
	{
		return $this->belongsTo('App\Kategori', 'Kategori')->withDefault([
			'Kategori' => 'No Category',
		]);
	}

	public function getUnit()
	{
		return $this->belongsTo('App\Unit', 'Unit')->withDefault([
			'Unit' => 'No Unit',
		]);
	}
}
