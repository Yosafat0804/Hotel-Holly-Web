@extends('layouts.adminlte')
@section('content')
    <div class="card shadow-lg" style="border-radius:24px; border:2px solid #d4af37; background:#fff;">
        <div class="card-header"
            style="background:#00008b; color:#fff; font-weight:bold; border-radius:22px 22px 0 0; letter-spacing:1px;">
            <h3 class="card-title" style="font-size:1.3rem; letter-spacing:1px;">
                <i class="fas fa-hotel" style="color:#d4af37; margin-right:8px;"></i>
                MAINTENANCE & RECEPTIONIST LIST
            </h3>
            <div class="card-tools">
                <a href="{{ route('supervisor.maintenanceReceptionist.create') }}" class="btn btn-sm"
                    style="background:#d4af37; color:#000; font-weight:bold; border-radius:16px; margin-left:12px;">
                    <i class="fas fa-plus"></i> Add
                </a>
            </div>
        </div>
        <div class="card-body" style="padding:2rem;">
            <table id="maintenanceReceptionistList" class="table table-hover shadow"
                style="width:100%; background:#fff; border-radius:18px; overflow:hidden; border:2px solid #d4af37;">
                <thead>
                    <tr class="text-center" style="background:#00008b; color:#fff;">
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Rating</th>
                        <th>Beri Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <tr class="text-center" style="background:#fffbe6; color:#000;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dt->name }}
                                <a href="{{ route('supervisor.maintenanceReceptionist.show', $dt->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            </td>
                            <td>{{ $dt->email }}</td>
                            <td>{{ $dt->phone }}</td>
                            <td>{{ ucfirst($dt->role) }}</td>

                            <td>
                                @if($dt->rating == 'Baik')
                                    <span class="badge badge-success" style="font-size:1rem;">Baik</span>
                                @elseif($dt->rating == 'Kurang Baik')
                                    <span class="badge badge-warning" style="font-size:1rem;">Kurang Baik</span>
                                @elseif($dt->rating == 'Buruk')
                                    <span class="badge badge-danger" style="font-size:1rem;">Buruk</span>
                                @else
                                    <span class="badge badge-secondary" style="font-size:1rem;">Belum Dinilai</span>
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('supervisor.maintenanceReceptionist.rate', $dt->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="rating" class="form-control" style="width:140px; font-weight:bold;"
                                        onchange="this.form.submit()">
                                        <option value="" disabled selected>Pilih Penilaian</option>
                                        <option value="Baik" style="color:#28a745;" {{ $dt->rating == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Kurang Baik" style="color:#ffc107;" {{ $dt->rating == 'Kurang Baik' ? 'selected' : '' }}>Kurang Baik</option>
                                        <option value="Buruk" style="color:#dc3545;" {{ $dt->rating == 'Buruk' ? 'selected' : '' }}>Buruk</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('js')
        <script>
            $(function() {
                $("#maintenanceReceptionistList").DataTable({
                    "responsive": true,
                    "paging": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('#maintenanceReceptionistList_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endsection 
@endsection
