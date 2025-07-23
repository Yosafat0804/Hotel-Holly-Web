<?php

namespace App\Http\Controllers;

use App\Models\HotelFacility;
use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomFacilityMaintenance;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function roomFacility()
    {
        $data = RoomFacility::all();
        return view('maintenance.roomFacility', compact('data'));
    }

    public function hotelFacility()
    {
        $data = HotelFacility::all();
        return view('maintenance.hotelFacility', compact('data'));
    }

    public function toggleRoomFacilityStatus($id)
    {
        $data = RoomFacility::findOrFail($id);
        $data->status = !$data->status;
        $data->save();

        return redirect()->back();
    }

    public function toggleHotelFacilityStatus($id)
    {
        $data = HotelFacility::findOrFail($id);
        $data->status = !$data->status;
        $data->save();

        return redirect()->back();
    }

    public function roomList()
    {
        $recepcionist = User::where('role', 'resepsionis')->first();
        $datas = Room::join('type_rooms', 'rooms.type_id', '=', 'type_rooms.id')
            ->select('rooms.*', 'type_rooms.name as type_name')
            ->orderBy('rooms.id', 'desc')
            ->get();
        return view('maintenance.roomList', compact('datas', 'recepcionist'));
    }

    public function detailRoom($id)
    {
        $room = Room::with('roomType')->findOrFail($id);
        $items = explode(',', $room->roomType->facilities);
        $isCheckedOut = \App\Models\Transaction::where('room_id', $id)
            ->where('status', 'checked out')
            ->exists();
        
        $data = [];

        foreach ($items as $item) {
            $maintenance = RoomFacilityMaintenance::where('room_id', $id)->where('facility_name', $item)->first();
            if ($maintenance) {
            } else {
                $maintenance = RoomFacilityMaintenance::create([
                    'room_id' => $id,
                    'facility_name' => $item,
                    'schedule' => null, // Default value
                    'schedule_note' => null, // Default value
                ]);
            }
            $data[] = $maintenance;
        }

        return view('maintenance.detailroom', compact('data', 'isCheckedOut'));
    }

    public function sendNoteToReceptionist(Request $request)
    {
        $transaction = Transaction::where('room_id', $request->room_id)
            ->first();

        $transaction->checkout_note = $request->note;
        $transaction->save();
        return back()->with('success', 'Catatan berhasil dikirim ke resepsionis.');
    }

    public function updateRoom(Request $request)
    {
        $maintenance = RoomFacilityMaintenance::findOrFail($request->id);
        $maintenance->update([
            'condition' => $request->condition,
            'schedule' => $request->schedule,
            'schedule_note' => $request->schedule_note,
        ]);
        return redirect()->route('maintenance.detailRoom', $maintenance->room_id)->with('success', 'Maintenance updated successfully.');
    }

    public function scheduleMaintenance(Request $request)
    {
        $datas = RoomFacilityMaintenance::with('room')->where('schedule', '!=', null)->get();
        return view('maintenance.scheduleList', compact('datas'));
    }
}
