@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Presentases') }}</h1>
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
                                <h3>Tabel Presentase</h3>
                                <a href="{{ route('presentases.create') }}" class="btn bg-maroon">Tambah Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th width="10px">No.</th>
                                        <th>Name</th>
                                        <th width="150px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($presentases as $presentase)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $presentase->name }}%</td>
                                            <td>
                                                <a href="{{ route('presentases.edit', $presentase->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('presentases.destroy', $presentase->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('presentases.destroy', $presentase->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true">
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
