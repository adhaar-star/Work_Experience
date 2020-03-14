<?php

namespace App\Http\Controllers;

//use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
//use Illuminate\Foundation\Validation\ValidatesRequests;
//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $layout;

    public function __construct() {
		view()->share([
			'description' => 'Haggler Application', 
			'author' => 'Harcharan Singh', 
			'header_title' => 'Haggler',
			'title' => 'Haggler'
			]);

	}
	protected function alert($text, $class) {
		return compact('text', 'class');
	}
}
