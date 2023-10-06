<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ParamCategory
 * 
 * @property int $id
 * @property string $category
 * 
 * @property Collection|ParamBook[] $param_books
 *
 * @package App\Models
 */
class ParamCategory extends Model
{
	protected $table = 'param_category';
	public $timestamps = false;

	protected $fillable = [
		'category'
	];

	public function param_books()
	{
		return $this->hasMany(ParamBook::class, 'categoryId');
	}
}
