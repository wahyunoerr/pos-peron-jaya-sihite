@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit Presentase') }}</h1>
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
                            <h3>Form Edit Presentase</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('presentases.update', $presentase->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="number" name="name" id="name" class="form-control" value="{{ $presentase->name }}" required>
                                    </div>
                                <div class="form-group">
                                    <div class="justify-items-center">
                                        <button type="submit" class="btn bg-maroon float-right">Update</button>
                                        <a href="{{ route('presentases.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
