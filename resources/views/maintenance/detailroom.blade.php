@extends('layouts.adminlte')
@section('content')
    <div class="card shadow-lg" style="border-radius:24px; border:2px solid #d4af37; background:#fff;">
        <div class="card-header"
            style="background:#00008b; color:#fff; font-weight:bold; border-radius:22px 22px 0 0; letter-spacing:1px;">
            <h3 class="card-title" style="font-size:1.3rem; letter-spacing:1px;">
                <i class="fas fa-couch" style="color:#d4af37; margin-right:8px;"></i>
                FACILITY ROOM LIST
            </h3>
        </div>
        <div class="card-body" style="padding:2rem;">
            <table id="facilityRoomlist" class="table table-hover shadow"
                style="width:100%; background:#fff; border-radius:18px; overflow:hidden; border:2px solid #d4af37;">
                <thead>
                    <tr class="text-center" style="background:#00008b; color:#fff;">
                        <th>No</th>
                        <th>Facility Name</th>
                        <th>Status</th>
                        <th>Maintenance Schedule</th>
                        <th>Note</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <form action="{{ route('maintenance.updateRoom') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $dt->id }}">
                            <tr class="text-center" style="background:#fffbe6; color:#000;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dt->facility_name }}</td>
                                <td>
                                    <select name="condition" class="form-control" style="width:140px; font-weight:bold;justify-self: center">
                                        <option {{ $dt->condition === 'Baik' ? 'selected' : '' }} value="Baik" style="color:#28a745;" >Baik</option>
                                        <option {{ $dt->condition === 'Kurang Baik' ? 'selected' : '' }} value="Kurang Baik" style="color:#ffc107;" >Kurang Baik</option>
                                        <option {{ $dt->condition === 'Buruk' ? 'selected' : '' }} value="Buruk" style="color:#dc3545;">Buruk</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="{{ $dt->schedule }}" name="schedule" type="date" class="form-control @error('schedule') is-invalid @enderror" value="{{ old('schedule') }}" autocomplete="schedule" autofocus style="border-radius:16px; border:1.5px solid #d4af37;">
                                </td>
                                <td>
                                    <input value="{{ $dt->schedule_note }}" name="schedule_note" type="text" class="form-control @error('schedule_note') is-invalid @enderror" value="{{ old('schedule_note') }}" autocomplete="schedule_note" autofocus style="border-radius:16px; border:1.5px solid #d4af37;">
                                </td>
                                <td>
                                    <div class="form-group float-right row mb-0">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary" style="background:#d4af37; color:#000; font-weight:bold; border-radius:16px; padding:8px 28px; border:none;">
                                                {{ __('Simpan') }}
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>
            </table>

            {{-- form checkout --}}
            @if($isCheckedOut)
                <div class="card mt-4" style="border:1.5px solid #d4af37; border-radius:16px;">
                    <div class="card-header" style="background:#00008b; color:#fff; border-radius:16px 16px 0 0;">
                        Kirim Catatan Maintenance ke Resepsionis
                    </div>
                    <div class="card-body">
                        <form action="{{ route('maintenance.sendNoteToReceptionist') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="room_id" value="{{ $dt->id }}">
                            <div class="form-group">
                                <label for="note">Catatan Pengecekan Barang & Kamar</label>
                                <textarea name="note" id="note" class="form-control" rows="3" required placeholder="Tulis hasil pengecekan..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-success" style="background:#d4af37; color:#000; font-weight:bold; border-radius:16px;">
                                Kirim ke Resepsionis
                            </button>
                        </form>
                        
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
