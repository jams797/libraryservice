<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TransacUser
 * 
 * @property int $id
 * @property string $name
 * @property string $user
 * @property string $pass
 * 
 * @property Collection|TransacBookUser[] $transac_book_users
 *
 * @package App\Models
 */
class TransacUser extends Model
{
	protected $table = 'transac_user';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'user',
		'pass'
	];

	public function transac_book_users()
	{
		return $this->hasMany(TransacBookUser::class, 'userId');
	}
}
