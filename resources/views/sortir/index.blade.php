@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Sortir Sawit') }}</h1>
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
                                <h3>Tabel Sortir Sawit</h3>
                                <a href="{{ route('sortirs.create') }}" class="btn bg-maroon">Tambah Data</a>
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
                                        <th>Jangkos</th>
                                        <th>Timbangan Bersih</th>
                                        <th>Harga Beli</th>
                                        <th>Penjual</th>
                                        <th width="150px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sortirs as $sortir)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sortir->timbang_masuk }}kg</td>
                                            <td>{{ $sortir->timbang_keluar }}kg</td>
                                            <td>{{ $sortir->berat_kotor }}kg</td>
                                            <td>{{ $sortir->status }}</td>
                                            <td>Rp. {{ number_format($sortir->harga, 0, ',', '.') }}</td>
                                            <td>{{ $sortir->presentase->name }}%</td>
                                            <td>{{ $sortir->jangkos ? $sortir->jangkos : 0 }}kg</td>
                                            <td>{{ $sortir->timbanganBersih }}kg</td>
                                            <td>Rp. {{ number_format($sortir->modal, 0, ',', '.') }}</td>
                                            <td>{{ $sortir->penjual->name }}</td>
                                            <td>
                                                <a href="{{ route('sortirs.edit', $sortir->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('sortirs.destroy', $sortir->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('sortirs.destroy', $sortir->id) }}"
                                                        class="btn btn-sm btn-danger" data-confirm-delete="true">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </form>
                                            </td>
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
