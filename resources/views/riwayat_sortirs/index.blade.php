@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Riwayat Sortirs') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>Tabel Riwayat Sortir</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Timbang Masuk</th>
                                        <th>Timbang Keluar</th>
                                        <th>Berat Kotor</th>
                                        <th>Status</th>
                                        <th>Harga</th>
                                        <th>Presentase</th>
                                        <th>Jongkos</th>
                                        <th>Timbangan Bersih</th>
                                        <th>Harga Beli</th>
                                        <th>Penjual</th>
                                        <th>Kode Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayatSortirs as $riwayatSortir)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $riwayatSortir->timbang_masuk }}kg</td>
                                            <td>{{ $riwayatSortir->timbang_keluar }}kg</td>
                                            <td>{{ $riwayatSortir->berat_kotor }}kg</td>
                                            <td>{{ $riwayatSortir->status }}</td>
                                            <td>Rp. {{ number_format($riwayatSortir->harga, 0, ',', '.') }}</td>
                                            <td>{{ $riwayatSortir->presentase->name ?? '-' }}%</td>
                                            <td>{{ $riwayatSortir->jangkos ? $riwayatSortir->jangkos : 0 }}kg</td>
                                            <td>{{ $riwayatSortir->timbangan_bersih }}kg</td>
                                            <td>Rp. {{ number_format($riwayatSortir->harga, 0, ',', '.') }}</td>
                                            <td>{{ $riwayatSortir->penjual->name ?? '-' }}</td>
                                            <td>{{ $riwayatSortir->transaksi->kode_transaksi ?? 'N/A' }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
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
@endsection
