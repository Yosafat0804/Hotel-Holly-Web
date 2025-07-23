@extends('layouts.adminlte')
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
                        Jadwal Maintenance
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
                                <th>Room Number</th>
                                <th>Name</th>
                                <th>Schedule</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr class="text-center" style="background:#fffbe6; color:#000;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->room->number }}</td>
                                    <td>{{ $data->facility_name }}</td>
                                    <td>{{ $data->schedule }}</td>
                                    <td>{{ $data->schedule_note }}</td>
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
    
@section('js')
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