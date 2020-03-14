<?php

namespace App\Models;

class Upload {
	
	public static function getPath( $folder ) {
		$path = public_path("assets/images/$folder");
		@mkdir($path, 0777);
		return $path;
	}

	public static function generateName() {
		return md5(uniqid());
	}

	public static function move( $folder, $request, $field, $return_original = false ) {

		$name = null;

		if (!$request->hasFile($field)) return $name;

		$file = $request->file($field);
		$extension = $file->getClientOriginalExtension();
		
		$path = self::getPath($folder);

		$name = self::generateName() . ".$extension";

		$move_to = "$path/original-{$name}";

		$file->move($path, "original-{$name}");

		$img = \Image::make($move_to);

		//$img->fit(80, 80);

		$move_to = "$path/$name";

		$img->save($move_to);

		return ($return_original === true) ? "original-{$name}" : $name;

	}

}