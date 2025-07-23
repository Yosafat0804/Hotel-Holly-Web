<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = 'type_rooms';
    protected $fillable = [
        'name',
        'foto',
        'price',
        'facilities',
        'information'
    ];

    public function photos()
    {
        return $this->hasMany(RoomTypePhoto::class, 'room_type_id');
    }

    public function getTotalRooms()
    {
        return $this->hasMany(Room::class, 'type_id', 'id')->where('status','=', 'a');;
    }
}
