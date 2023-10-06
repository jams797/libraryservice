<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ParamBook
 * 
 * @property int $id
 * @property string $book
 * @property string $description
 * @property int $categoryId
 * 
 * @property ParamCategory $param_category
 * @property Collection|ConfigLocationBook[] $config_location_books
 * @property Collection|TransacBookUser[] $transac_book_users
 *
 * @package App\Models
 */
class ParamBook extends Model
{
	protected $table = 'param_book';
	public $timestamps = false;

	protected $casts = [
		'categoryId' => 'int'
	];

	protected $fillable = [
		'book',
		'description',
		'categoryId'
	];

	public function param_category()
	{
		return $this->belongsTo(ParamCategory::class, 'categoryId');
	}

	public function config_location_books()
	{
		return $this->hasMany(ConfigLocationBook::class, 'bookId');
	}

	public function transac_book_users()
	{
		return $this->hasMany(TransacBookUser::class, 'bookId');
	}
}
