@extends('layouts.adminlte')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg" style="border-radius:24px; border:2px solid #d4af37; background:#fff;">
        <div class="card-header"
            style="background:#00008b; color:#fff; font-weight:bold; border-radius:22px 22px 0 0; letter-spacing:1px;">
            <h3 class="card-title" style="font-size:1.3rem; letter-spacing:1px;">
                <i class="fas fa-user" style="color:#d4af37; margin-right:8px;"></i>
                Detail Maintenance/Receptionist
            </h3>
        </div>
        <div class="card-body" style="padding:2rem;">
            <table class="table table-bordered" style="background:#fffbe6; border-radius:18px;">
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
                <tr>
                    <th>Rating</th>
                    <td>
                        <form action="{{ route('supervisor.maintenanceReceptionist.rate', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <select name="rating" class="form-control" style="width:140px; font-weight:bold;"
                                onchange="this.form.submit()">
                                <option value="" disabled selected>Pilih Penilaian</option>
                                <option value="Baik" style="color:#28a745;" {{ $user->rating == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Kurang Baik" style="color:#ffc107;" {{ $user->rating == 'Kurang Baik' ? 'selected' : '' }}>Kurang Baik</option>
                                <option value="Buruk" style="color:#dc3545;" {{ $user->rating == 'Buruk' ? 'selected' : '' }}>Buruk</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td>
                        <form action="{{ route('supervisor.maintenanceReceptionist.note', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <textarea name="note" class="form-control" rows="3" placeholder="Tulis catatan...">{{ old('note', $user->note) }}</textarea>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Simpan Catatan</button>
                        </form>
                    </td>
                </tr>
            </table>
            <a href="{{ route('supervisor.maintenanceReceptionist') }}" class="btn btn-warning mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
