<?php

namespace App\Http\Controllers;

use App\Models\HotelFacility;
use App\Models\RoomFacility;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function roomFacility()
    {
        $data = RoomFacility::all();
        return view('supervisor.roomFacility', compact('data'));
    }

    public function hotelFacility()
    {
        $data = HotelFacility::all();
        return view('supervisor.hotelFacility', compact('data'));
    }

    public function maintenanceAndReceptionist()
    {
        $data = User::whereIn('role', ['maintenance', 'resepsionis'])->get();
        return view('supervisor.maintenance-receptionist.index', compact('data'));
    }

    public function showMaintenanceAndReceptionist($id)
    {
        $user = User::findOrFail($id);
        return view('supervisor.maintenance-receptionist.show', compact('user'));
    }

    public function rateMaintenanceAndReceptionist(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|in:Baik,Kurang Baik,Buruk',
        ]);

        $user = \App\Models\User::findOrFail($id);
        $user->rating = $request->rating;
        $user->save();

        return redirect()->back()->with('success', 'Rate successful!');
    }

    public function saveNote(Request $request, $id)
    {
        $request->validate([
            'note' => 'nullable|string|max:1000',
        ]);

        $user = User::findOrFail($id);
        $user->note = $request->note;
        $user->save();

        return redirect()->back()->with('success', 'Catatan berhasil disimpan!');
    }

    public function createMaintenanceAndReceptionist()
    {
        return view('supervisor.maintenance-receptionist.add');
    }

    public function storeMaintenanceAndReceptionist(Request $request)
    {
        if($request->role == 'maintenance'){
            $role = 'maintenance';
        } else{
            $role = 'resepsionis';
        }

        $post = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        if ($post){
            return redirect()->route('supervisor.maintenanceReceptionist')->with('message', 'Data created!');
        } else{
            return redirect()->route('supervisor.maintenanceReceptionist.create')->with('message', 'Failed to create data!');
        }
    }
}
