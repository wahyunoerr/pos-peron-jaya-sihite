@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Transaksi</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Transaksi</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Jumlah Transaksi</th>
                                        <th>Keuntungan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksis as $transaksi)
                                        <tr>
                                            <td>{{ $transaksi->kode_transaksi }}</td>
                                            <td>{{ $transaksi->tanggal_transaksi }}</td>
                                            <td>{{ $transaksi->jumlah_transaksi }}</td>
                                            <td>Rp.
                                                {{ number_format($transaksi->calculateProfitFromDetails(), 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('transaksis.show', $transaksi->id) }}"
                                                    class="btn btn-info btn-sm">Detail</a>
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

@section('scripts')
    <script>
        $('#table').DataTable({
            responsive: true,
            autoWidth: true,
            processing: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
        });
    </script>
@endsection
