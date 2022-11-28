<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Products extends Model
{
    use HasFactory;
    use Billable;
	protected $fillable = [

	         'name', 'price' , 'description'

	];
}
