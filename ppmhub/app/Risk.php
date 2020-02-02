<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Risk extends Model
{
	protected $table = "risk_analysis";
        
        public $timestamp = true;
		
		public static function kamal($id){
	
		$a = $id;
		return $a;
		}
}
