@extends('layouts.adminlte')
@section('content')
<div class="card">
    <div class="card-header">Tambah Foto Room Type</div>
    <div class="card-body">
        <form action="{{ route('roomtype.photo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="room_type_id">Room Type</label>
                <select name="room_type_id" class="form-control" required>
                    <option value="">-- Pilih Room Type --</option>
                    @foreach($roomTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/jpg,image/jpeg,image/png" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection