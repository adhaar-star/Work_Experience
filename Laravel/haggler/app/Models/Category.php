<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'categories';

	protected $primaryKey = 'categoryId';


	protected $hidden = ['created_at', 'updated_at'];


	public static function rules( $type = 'create' )
	{
	    $rules =  [
	      'categoryName'        => 'required|max:100',
	      'categoryParentId' => 'int',
	      'categoryPercentage'  => 'required|numeric',
	      'categoryImage'       => 'required|mimes:png,jpg,jpeg|max:2048'
	    ];

	    if ($type == 'update') {
	    	unset($rules['categoryImage']);
	    }

	    if (\Input::get('categoryParentId') > 0) {
	    	$rules['categoryImage'] = 'mimes:png,jpg,jpeg|max:2048';
	    }

	    return $rules;
	}

	public function toArray()
    {
        $array = parent::toArray();
        if (isset($this->attributes['categoryImage'])) {
        	$array['image'] = $this->getcategoryImageAttribute();
        	$array['originalImage'] = !empty($this->attributes['categoryImage']) ? \URL::to('assets/images/category/' . $this->attributes['categoryImage'] ) : '';
    	}
        return $array;
    }

	public function parent_category() {
		return $this->hasOne('\App\Models\Category', 'categoryId', 'categoryParentId');
	}
	
	public function children() {
		return $this->hasMany('\App\Models\Category', 'categoryParentId', 'categoryId')->with('children');
	}

	public function subCat() {
		return $this->hasMany('\App\Models\Category', 'categoryParentId', 'categoryId')->with('subCat')->selectRaw('categoryId as id, categoryId, categoryName as name, categoryParentId, categoryImage');
	}

	public function getcategoryImageAttribute() {

		if (!isset($this->attributes['categoryImage'])) return "";

		return \URL::to('assets/images/category/' . $this->attributes['categoryImage'] );
	}

	public static function getChildren($item, $selected = null) {
		
		$options = "";

		$id = $item->categoryId;

		$categories = self::where('categoryParentId', $id)->get();

		if (!empty($categories->all())) {
			foreach ($categories as $category) {
				$is_selected = $selected == $category->categoryId ? 'selected' : '';
				$options .= "<option value='{$category->categoryId}' $is_selected>{$category->categoryName}</option>";

				$children = self::getChildren($category);

				if (!empty($children)) {
					$options .= "<optgroup label='{$category->categoryName}'>";
					$options .= $children;
					$options .= '</optgroup>';
				}
			}
		}

		return $options;
	}


	public static function getChildrenList($item, $selected = null, $class = '', $parent = null) {
		
		$options = '';

		$id = $item->categoryId;

		$categories = self::where('categoryParentId', $id)->get();

		if (!empty($categories->all())) {
			$options .= '<ul class="sub-cat-tree">';
			foreach ($categories as $category) {
				$is_selected = $selected == $category->categoryId ? 'selected' : '';

				

				$options .= "<li><span><input data-parent='{$category->categoryParentId}' class='cat-item {$class} cat-{$category->categoryParentId} cat-{$category->categoryId}' type='checkbox' name='categoryIds[]' value='{$category->categoryId}'> {$category->categoryName} </span>";

				$children = self::getChildrenList($category, null, 'cat-' . $category->categoryParentId);

				$options .= "$children</li>";
			
			}
			$options .= '</ul>';
		}

		return $options;
	}

	public function delete() {

		if (!empty($this->attributes['categoryImage'])) {

			@unlink(public_path('assets/images/category/thumb-' . $this->attributes['categoryImage']));
			@unlink(public_path('assets/images/category/' . $this->attributes['categoryImage']));
		}

		return parent::delete();
	}

}