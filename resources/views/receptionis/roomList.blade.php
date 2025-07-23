@extends('layouts.app')
@section('content')
<div class="container-fluid px-3">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow-lg" style="border-radius:24px; border:2px solid #d4af37; background:#fff;">
            <div class="card-header"
                style="background:#00008b; color:#fff; font-weight:bold; border-radius:22px 22px 0 0; letter-spacing:1px;">
                <h2 style="font-weight:bold; letter-spacing:1px; font-size:2rem; margin-bottom:0;">
                    <center>
                        <i class="fas fa-list-alt" style="color:#d4af37; margin-right:8px;"></i>
                        Daftar Kamar
                    </center>
                </h2>
            </div>
            <div class="card-body" style="padding:2rem;">
                <div class="col-md-12">
                     <table id="transaction" class="table table-hover shadow"
                        style="width:100%; background:#fff; border-radius:18px; overflow:hidden; border:2px solid #d4af37;">
                        <thead>
                            <tr class="text-center" style="background:#00008b; color:#fff;">
                                <th>No</th>
                                <th>Room Type</th>
                                <th>Number</th>
                                <th>Info</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr class="text-center" style="background:#fffbe6; color:#000;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->type_name }}</td>
                                    <td>{{ $data->number }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($data->information, 50) }}</td>
                                    <td>
                                        @if ($data->status == 'a')
                                            <span style="color:#28a745; font-weight:bold;">Available</span>
                                        @elseif ($data->status == 'o')
                                            <span style="color:#dc3545; font-weight:bold;">Occupied</span>
                                        @elseif ($data->status == 'r')
                                            <span style="color:#d4af37; font-weight:bold;">Reserved</span>
                                        @elseif ($data->status == 'os')
                                            <span style="color:#6c757d; font-weight:bold;">Out of Service</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $lastTransaction = \App\Models\Transaction::where('room_id', $data->id)
                                                ->where('status', 'checked out')
                                                ->latest('updated_at')
                                                ->first();
                                        @endphp
                                        @if($lastTransaction && $lastTransaction->checkout_note)
                                            <a href="{{ route('receptionis.maintenanceNote', $data->id) }}" class="btn btn-info btn-sm">
                                                Lihat Catatan Maintenance
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
    
@section('script')
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
<script>
    $(function() {
        $("#transaction").DataTable({
            "responsive": true,
            "paging" : false,
            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        });
    });
</script>
@endsection