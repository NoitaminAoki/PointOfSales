<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class HeaderTransaction extends Eloquent
{
    protected $connection = 'mongodb';
	protected $collection = 'headerTransaction';

	public function getUser()
	{
		return $this->BelongsTo('App\User', 'UserId')->withDefault([
			'name' => 'No Employee',
		]);
	}
}
