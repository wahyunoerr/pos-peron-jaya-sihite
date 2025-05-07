@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Truks') }}</h1>
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
                                <h3>Tabel Truk</h3>
                                <a href="{{ route('truks.create') }}" class="btn bg-maroon">Tambah Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Name</th>
                                        <th>No Plat</th>
                                        <th>Status</th>
                                        <th width="150px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($truks as $truk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $truk->name }}</td>
                                            <td>{{ $truk->noPlat }}</td>
                                            <td>{{ $truk->status }}</td>
                                            <td>
                                                <a href="{{ route('truks.edit', $truk->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('truks.destroy', $truk->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-confirm-delete="true">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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
