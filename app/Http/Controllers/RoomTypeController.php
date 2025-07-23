<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomType;
use App\Models\RoomTypePhoto;
use Illuminate\Http\Request;
use Auth;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = RoomType::all();
        return view('admin.roomType.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roomTypes = RoomType::all(); // Ambil semua room type dari database
        // return view('admin.roomType.photo.create', compact('roomTypes')); // Kirim ke view

        // $data = RoomType::find($id);
        $roomFacilities = RoomFacility::all();
        // $data->facilities = explode(', ', $data->facilities);
        return view('admin.roomType.add',compact('roomFacilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imgName = ($request->foto != NULL) ? time() . $request->foto->getClientOriginalName() : NULL;
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'information' => 'required|string',
            'facilities' => 'required|array',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->foto != NULL) {
            $request->foto->move(public_path('images/tipekamar'), $imgName);
        } else {
            $imgName = '';
        }   
        
        if ($request['facilities'] != NULL) {
            $request['facilities'] = implode(", ", $request['facilities']);
        }

        $post = RoomType::create([
            'name' =>$request->name,
            'price' => $request->price,
            'information' =>$request->information,
            'facilities' => $request->facilities,
            'foto' => $imgName,
        ]);

        if($post){
            return redirect()->route('roomtype.index')->with('message', 'Data created!');
        }else{
            return redirect()->route('roomtype.index')->with('message', 'Failed to create data!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = RoomType::find($id);
        $roomFacilities = RoomFacility::all();
        $data->facilities = explode(', ', $data->facilities);
        return view('admin.roomType.edit',compact('data', 'roomFacilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->foto != NULL) {
            $imgName = time() . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('images/tipekamar'), $imgName);
        } else {
            $data = RoomType::find($id);
            $imgName = $data->foto;
        }

        if ($request['facilities'] != NULL) {
            $request['facilities'] = implode(", ", $request['facilities']);
        }

        $post = RoomType::find($id)->update([
            'name' =>$request->name,
            'price' => $request->price,
            'information' =>$request->information,
            'facilities' => $request->facilities,
            'foto' => $imgName,
        ]);

        if($post){
            return redirect()->route('roomtype.index')->with('message', 'Data created!');
        } else{
            return redirect()->route('roomtype.index')->with('message', 'Failed to create data!');
        }
    }

    public function createPhoto()
    {
        $roomTypes = RoomType::all();
        return view('admin.roomType.photo.create', compact('roomTypes'));
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required|exists:type_rooms,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imgName = time() . $request->foto->getClientOriginalName();
        $request->foto->move(public_path('images/tipekamar'), $imgName);

        RoomTypePhoto::create([
            'room_type_id' => $request->room_type_id,
            'foto' => $imgName,
        ]);

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoomType::destroy($id);
        return redirect()->route('roomtype.index');
    }

    public function detailRoom($id)
    {
        if (!Auth::check() OR auth()->user()->role == 'customer') {
            $data = RoomType::find($id);
            $jumlahTersedia = Room::where('status', '=', 'a')->where('type_id', '=', $id)->count();
            $lastRooms = Room::where('type_id', $id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
             return view('admin.roomType.detail-room', compact('data', 'jumlahTersedia', 'lastRooms'));
        } elseif (auth()->user()->role == 'admin') {
            return redirect()->route('home');
        } elseif(auth()->user()->role == 'resepsionis'){
            return redirect()->route('home');
        }

    }
}
