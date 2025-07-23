<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Transaction;

class ReceptionistController extends Controller
{
    public function roomList()
    {
        $datas = Room::join('type_rooms', 'rooms.type_id', '=', 'type_rooms.id')
            ->select('rooms.*', 'type_rooms.name as type_name')
            ->orderBy('rooms.id', 'desc')
            ->get();
        return view('receptionis.roomList', compact('datas'));
    }

    public function maintenanceNote($roomId)
    {
        $room = Room::with('roomType')->findOrFail($roomId);
        $transaction = Transaction::where('room_id', $roomId)
            ->where('status', 'checked out')
            ->latest('updated_at')
            ->first();

        return view('receptionis.maintenanceNote', compact('room', 'transaction'));
    }
}
