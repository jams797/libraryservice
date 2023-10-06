<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConfigLocationBook
 * 
 * @property int $id
 * @property int $cant
 * @property float $price
 * @property int $bookId
 * @property int $locationId
 * 
 * @property ParamBook $param_book
 * @property ParamLocation $param_location
 *
 * @package App\Models
 */
class ConfigLocationBook extends Model
{
	protected $table = 'config_location_book';
	public $timestamps = false;

	protected $casts = [
		'cant' => 'int',
		'price' => 'float',
		'bookId' => 'int',
		'locationId' => 'int'
	];

	protected $fillable = [
		'cant',
		'price',
		'bookId',
		'locationId'
	];

	public function param_book()
	{
		return $this->belongsTo(ParamBook::class, 'bookId');
	}

	public function param_location()
	{
		return $this->belongsTo(ParamLocation::class, 'locationId');
	}
}
