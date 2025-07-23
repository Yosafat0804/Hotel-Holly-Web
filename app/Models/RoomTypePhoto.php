<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypePhoto extends Model
{
	use HasFactory;
	protected $table = 'type_room_photos';
	protected $fillable = ['room_type_id', 'foto'];

	public function roomType()
	{
		return $this->belongsTo(RoomType::class, 'room_type_id');
	}
}