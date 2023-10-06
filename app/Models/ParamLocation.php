<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ParamLocation
 * 
 * @property int $id
 * @property string $location
 * 
 * @property Collection|ConfigLocationBook[] $config_location_books
 * @property Collection|TransacBookUser[] $transac_book_users
 *
 * @package App\Models
 */
class ParamLocation extends Model
{
	protected $table = 'param_location';
	public $timestamps = false;

	protected $fillable = [
		'location'
	];

	public function config_location_books()
	{
		return $this->hasMany(ConfigLocationBook::class, 'locationId');
	}

	public function transac_book_users()
	{
		return $this->hasMany(TransacBookUser::class, 'locationId');
	}
}
