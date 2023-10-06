<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TransacBookUser
 * 
 * @property int $id
 * @property int $userId
 * @property int $bookId
 * @property int $locationId
 * @property string $estatus
 * 
 * @property TransacUser $transac_user
 * @property ParamBook $param_book
 * @property ParamLocation $param_location
 *
 * @package App\Models
 */
class TransacBookUser extends Model
{
	protected $table = 'transac_book_user';
	public $timestamps = false;

	protected $casts = [
		'userId' => 'int',
		'bookId' => 'int',
		'locationId' => 'int'
	];

	protected $fillable = [
		'userId',
		'bookId',
		'locationId',
		'estatus'
	];

	public function transac_user()
	{
		return $this->belongsTo(TransacUser::class, 'userId');
	}

	public function param_book()
	{
		return $this->belongsTo(ParamBook::class, 'bookId');
	}

	public function param_location()
	{
		return $this->belongsTo(ParamLocation::class, 'locationId');
	}
}
