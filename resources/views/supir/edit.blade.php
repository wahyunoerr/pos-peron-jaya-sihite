@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit Supir') }}</h1>
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
                            <h3>Form Edit Supir</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('supirs.update', $supir->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $supir->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="noTelp">No Telepon</label>
                                    <input type="text" name="noTelp" id="noTelp" class="form-control"
                                        value="{{ $supir->noTelp }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" required>{{ $supir->alamat }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="aktif" {{ $supir->status == 'aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="tidak aktif" {{ $supir->status == 'tidak aktif' ? 'selected' : '' }}>
                                            Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="truk_id">Truk</label>
                                    <select name="truk_id" id="truk_id" class="form-control">
                                        <option value="">Pilih Truk</option>
                                        @foreach ($truks as $truk)
                                            <option value="{{ $truk->id }}"
                                                {{ $supir->truk_id == $truk->id ? 'selected' : '' }}>{{ $truk->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fotoSupir">Foto Supir</label>
                                    <input type="file" name="fotoSupir" id="fotoSupir" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="justify-items-center">
                                        <button type="submit" class="btn bg-maroon float-right">Update</button>
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
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('imagePreview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'imagePreview';
                    preview.style.maxWidth = '200px';
                    preview.style.marginTop = '10px';
                    event.target.parentNode.appendChild(preview);
                }
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
