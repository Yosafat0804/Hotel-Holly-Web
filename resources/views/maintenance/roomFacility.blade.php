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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <tr class="text-center" style="background:#fffbe6; color:#000;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dt->facility_name }}</td>
                            <td>
                                <form action="{{ route('maintenance.roomFacility.toggleStatus', $dt->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        style="background-color: {{ $dt->status ? '#00008b' : '#d4af37' }}; color: white;">
                                        {{ $dt->status ? 'Available' : 'Not Available' }}
                                    </button>
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
            $("#facilityRoomlist").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#facilityRoomlist_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
@endsection
