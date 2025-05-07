@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Create Supir') }}</h1>
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
                            <h3>Form Create Supir</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('supirs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="noTelp">No Telepon</label>
                                    <input type="text" name="noTelp" id="noTelp" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="truk_id">Truk</label>
                                    <select name="truk_id" id="truk_id" class="form-control">
                                        <option value="">Pilih Truk</option>
                                        @foreach ($truks as $truk)
                                            <option value="{{ $truk->id }}">{{ $truk->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fotoSupir">Foto Supir</label>
                                    <input type="file" name="fotoSupir" id="fotoSupir" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="justify-items-center">
                                        <button type="submit" class="btn bg-maroon float-right">Submit</button>
                                        <a href="{{ route('supirs.index') }}" class="btn btn-secondary ml-2">Kembali</a>
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
@section('scripts')
    <script>
        document.getElementById('fotoSupir').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview') || document.createElement('img');
            preview.id = 'imagePreview';
            preview.style.maxWidth = '200px';
            preview.style.marginTop = '10px';
            if (!document.getElementById('imagePreview')) {
                event.target.parentNode.appendChild(preview);
            }

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
