<?php

namespace App\Http\Controllers;

use App\Models\HotelFacility;
use App\Models\RoomFacility;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function userDetail()
    {
        $user = auth()->user();
        return view('maintenance.detail', compact('user'));
    }

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
}
