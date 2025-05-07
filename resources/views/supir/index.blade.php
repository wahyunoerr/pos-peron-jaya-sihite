@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Supirs') }}</h1>
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
                                <h3>Tabel Supir</h3>
                                <a href="{{ route('supirs.create') }}" class="btn bg-maroon">Tambah Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Truk</th>
                                        <th>Foto</th>
                                        <th width="150px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supirs as $supir)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $supir->name }}</td>
                                            <td>{{ $supir->noTelp }}</td>
                                            <td>{{ $supir->alamat }}</td>
                                            <td>{{ $supir->truk->name ?? '-' }}</td>
                                            <td>
                                                <img width="80px" height="80px"
                                                    style="border-radius: 50%; object-fit: cover;"
                                                    src="{{ $supir->fotoSupir ? asset('storage/' . $supir->fotoSupir) : asset('images/Avatar.png') }}"
                                                    alt="Foto Supir">
                                            </td>
                                            <td>
                                                <a href="{{ route('supirs.edit', $supir->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('supirs.destroy', $supir->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('supirs.destroy', $supir->id) }}"
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
