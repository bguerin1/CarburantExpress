<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeCarburant
 * 
 * @property int $id
 * @property string $libelle
 *
 * @package App\Models
 */
class TypeCarburant extends Model
{
	protected $table = 'type_carburant';
	public $timestamps = false;

	protected $fillable = [
		'libelle'
	];
}
