@extends('layouts.template')
@section('content')
<section class="accomodation_area section_gap mt-5">
    <div class="container">
        <div class="card shadow-lg" style="border-radius:24px; border:2px solid #d4af37; background:#fff;">
            <div class="card-header"
                style="background:#00008b; color:#fff; font-weight:bold; border-radius:22px 22px 0 0; letter-spacing:1px;">
                <h3 class="card-title" style="font-size:1.3rem; letter-spacing:1px;">
                    <i class="fas fa-coins" style="color:#d4af37; margin-right:8px;"></i>
                    Laporan Pemasukan Hotel
                </h3>
            </div>
            <div class="card-body" style="padding:2rem;">
                <h4 class="mb-4">Total Pemasukan: <span class="badge badge-success" style="font-size:1.2rem;">@currency($totalIncome)</span></h4>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center" style="background:#00008b; color:#fff;">
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Tipe Kamar</th>
                            <th>Jumlah Pesanan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $trx)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $trx->user->name ?? '-' }}</td>
                                <td>{{ $trx->room->roomType->name ?? '-' }}</td>
                                <td>{{ $trx->many_room }}</td>
                                <td>{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                                <td>@currency($trx->payment->price ?? 0)</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-center">
                                <strong>Laba Bersih</strong >
                            </td>
                            <td class="text-center">
                                {{-- Pemasukan bersih --}}
                                <strong>
                                    @currency($totalIncome)
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection