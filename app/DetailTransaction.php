<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DetailTransaction extends Eloquent
{
    protected $connection = 'mongodb';
	protected $collection = 'detailTransaction';

	public function getProduct()
	{
		return $this->BelongsTo('App\Product', 'ProductId')->withDefault([
			'Name' => 'No Product',
		]);
	}
}
