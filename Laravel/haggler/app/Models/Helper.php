<?php

namespace APP\Models;

use Auth;

class Helper {
	

	public static function alert() {

		$alert = \Session::get('message');


		if (!empty($alert)) {
			extract($alert);
			return "<div class='alert $class'>$text</div>";
		}

	}

	public static function inlineError() {

		$alert = \Session::get('inline_error');

		if (!empty($alert)) {
			extract($alert);
			return "<div class='alert $class'>$text</div>";
		}

	}

	public static function adminURL( $uri , $params = null ) {

		$b = \Config::get('admin_base', 'admin');

		if (Auth::check() && Auth::user()->role == 'vendor') {
			$b = \Config::get('vendor_base', 'vendor');
		}

		$uri =  $b . "/$uri";
		return \URL::to( $uri , $params);
	}

	public static function adminBase( $uri = null ) {
		$base = \Config::get('admin_base', 'admin');

		if (Auth::check() && Auth::user()->role == 'vendor') {
			$base = \Config::get('vendor_base', 'vendor');
		}

		if (is_null($uri)) return "/$base";

		return $base . '/' . trim($uri, '/');
	}

}