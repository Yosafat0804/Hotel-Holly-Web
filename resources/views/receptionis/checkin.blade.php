@extends('layouts.app')
@section('content')
<div class="container">
    
    <div class="card shadow-lg mt-4" style="border-radius: 24px; border: 2px solid #d4af37; background: #fff;">
        <div class="card-header" style="background: #00008b; color: #fff; font-weight: bold; border-radius: 22px 22px 0 0; letter-spacing: 1px; font-size: 1.2rem;">
            <i class="fas fa-users" style="color:#d4af37; margin-right:8px;"></i>
            Checked In Customer
        </div>
        <div class="card-body" style="padding:2rem;">
            <table id="transaction" class="table table-hover shadow" style="width:100%; background:#fff; border-radius:18px; overflow:hidden;">
                <thead>
                    <tr class="text-center" style="background:#00008b; color:#fff;">
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Type Kamar</th>
                        <th>Nomor Kamar</th>
                        <th>Jumlah Pesanan</th>
                        <th>Check in - Check out</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $item)
                        <tr class="text-center" style="background:#fffbe6; color:#000;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->room->roomType->name }}</td>
                            <td>{{ $item->roomNumber->number }}</td>
                            <td>{{ $item->many_room }}</td>
                            <td>{{ $item->check_in . ' - ' . $item->check_out}}</td>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            <td>
                                @if( $item->status == 'verified' )
                                    <a role="button" id="btnCheckin" data-transaction-id="{{ $item->room_id }}" data-user-name="{{ $item->user->name }}" class="btn btn-sm btn-success" style="border-radius:18px; font-weight:bold;">Check In</a>
                                @elseif ($item->check_out == now() && $item->status == 'checked in' || $item->check_in == $item->check_out)
                                    <a role="button" id="btnCheckout" data-transaction-id="{{ $item->room_id }}" data-user-name="{{ $item->user->name }}" class="btn btn-sm btn-danger" style="border-radius:18px; font-weight:bold;">Check Out</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>
    $(function() {
        $("#transaction").DataTable({
            "responsive": true,
            "paging" : false,
            "dom": "Bfrtip",
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#facilityList_wrapper .col-md-6:eq(0)');

        $(`a[id^="btnCheckout"]`).on('click', function(e) {
            e.preventDefault();

            const transactionId = $(this).data('transaction-id');
            const userName = $(this).data('user-name');

            Swal.fire({
                title: 'Konfirmasi Checkout',
                text: "Lakukan Checkout pada transaksi " + userName + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('receptionis.checkout', '') }}/${transactionId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            room_id: transactionId,
                            status: 'checked out'
                        })
                    }).then(response => {
                        console.log(response);
                        if (response.ok) {
                            Swal.fire(
                                'Berhasil!',
                                'Transaksi ' + userName + ' berhasil di Checkout.',
                                'success'
                            );

                            location.reload();

                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Transaksi ' + userName + ' gagal di Checkout.',
                                'error'
                            );
                        }
                    }).catch(error => {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat memproses permintaan.',
                            'error'
                        );
                    });
                }
            });
        });


        $(`a[id^="btnCheckin"]`).on('click', function(e) {
            e.preventDefault();
            
            const transactionId = $(this).data('transaction-id');
            const userName = $(this).data('user-name');

            Swal.fire({
                title: 'Konfirmasi Checkin',
                text: "Lakukan Checkin pada transaksi " + userName + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('receptionis.checkin', '') }}/${transactionId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            room_id: transactionId,
                            status: 'checked in'
                        })
                    }).then(response => {
                        console.log(response);
                        if (response.ok) {
                            Swal.fire(
                                'Berhasil!',
                                'Transaksi ' + userName + ' berhasil di Checkin.',
                                'success'
                            );
                            location.reload();
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Transaksi ' + userName + ' gagal di Checkin.',
                                'error'
                            );
                        }
                    }).catch(error => {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat memproses permintaan.',
                            'error'
                        );
                    });
                }
            });
        });
    });
</script>
@endsection