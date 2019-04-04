<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ReportTransaction extends Eloquent
{
    protected $connection = 'mongodb';
	protected $collection = 'reportTransaction';
}
