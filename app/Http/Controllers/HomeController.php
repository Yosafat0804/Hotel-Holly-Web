<?php

namespace App\Http\Controllers;

use App\Models\HotelFacility;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roomTypes = RoomType::all();
        $datas = HotelFacility::all();
        // dd($datas);
        if (!Auth::check()) {
            return view('landing', compact(['roomTypes', 'datas']));
        } elseif (auth()->user()->role == 'admin') {
            return redirect()->route('admin.home');
        } elseif (auth()->user()->role == 'resepsionis') {
            return view('receptionis.home');
        } elseif (auth()->user()->role == 'customer') {
            return view('landing', compact('roomTypes', 'datas'));
        } elseif (auth()->user()->role == 'maintenance') {
            return view('maintenance.home');
        } elseif (auth()->user()->role == 'supervisor') {
            return view('supervisor.home');
        }
    }

    public function admin()
    {
        return view('admin.home');
    }

    public function receptionis()
    {
        return view('receptionis.home');
    }

    public function maintenance()
    {
        return view('maintenance.home');
    }

    public function supervisor()
    {
        return view('supervisor.home');
    }

    public function storeProfile(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'address'   => 'required|string|max:255',
            'gender'    => 'required|in:male,female,other',
            'job'       => 'required|string|max:100',
            'birthdate' => 'required|date|before:today',
        ]);

        $user = Auth::user();

        Customer::updateOrCreate(
            ['user_id' => $user->id], 
            [
                'name'      => $validated['name'],
                'address'   => $validated['address'],
                'gender'    => $validated['gender'],
                'job'       => $validated['job'],
                'birthdate' => $validated['birthdate'],
            ]
        );

        return back()->with('success', 'Profile updated successfully!');
    }

}
