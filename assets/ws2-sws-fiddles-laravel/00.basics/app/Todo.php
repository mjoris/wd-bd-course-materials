<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	protected $table = 'todolist';
	
	public $timestamps = false;
	
	protected $guarded = ['user_id'];
}
