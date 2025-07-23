@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card shadow-lg" style="border-radius:24px; border:2px solid #d4af37;">
        <div class="card-header" style="background:#00008b; color:#fff; border-radius:22px 22px 0 0;">
            <h4>Catatan Maintenance Kamar</h4>
        </div>
        <div class="card-body">
            <h5>Kamar: {{ $room->number }} ({{ $room->roomType->name ?? '-' }})</h5>
            <hr>
            <strong>Catatan Maintenance:</strong>
            <div class="mt-2" style="white-space: pre-line;">
                {{ $transaction->checkout_note ?? 'Tidak ada catatan.' }}
            </div>
            <a href="{{ route('receptionis.roomList') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Kamar</a>
        </div>
    </div>
</div>
@endsection