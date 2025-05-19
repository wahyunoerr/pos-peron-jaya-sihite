@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit Sortir Sawit') }}</h1>
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
                            <h3>Form Edit Sortir</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sortirs.update', $sortir->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="timbang_masuk">Timbang Masuk</label>
                                    <input type="text" name="timbang_masuk" id="timbang_masuk" class="form-control"
                                        value="{{ $sortir->timbang_masuk }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="timbang_keluar">Timbang Keluar</label>
                                    <input type="text" name="timbang_keluar" id="timbang_keluar" class="form-control"
                                        value="{{ $sortir->timbang_keluar }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="berat_kotor">Berat Kotor</label>
                                    <input type="text" name="berat_kotor" id="berat_kotor" class="form-control"
                                        value="{{ $sortir->berat_kotor }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="bagus" {{ $sortir->status == 'bagus' ? 'selected' : '' }}>Bagus
                                        </option>
                                        <option value="jelek" {{ $sortir->status == 'jelek' ? 'selected' : '' }}>Jelek
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control"
                                        value="{{ $sortir->harga }}" required>
                                </div>
                                <div class="form-group" id="jangkos-container"
                                    style="display: {{ $sortir->jangkos ? 'block' : 'none' }};">
                                    <label for="jangkos">Jangkos</label>
                                    <input type="text" name="jangkos" id="jangkos" class="form-control"
                                        value="{{ $sortir->jangkos }}">
                                </div>
                                <div class="form-group">
                                    <label for="presentase_id">Presentase</label>
                                    <select name="presentase_id" id="presentase_id" class="form-control" required>
                                        @foreach ($presentases as $presentase)
                                            <option value="{{ $presentase->id }}"
                                                {{ $sortir->presentase_id == $presentase->id ? 'selected' : '' }}>
                                                {{ $presentase->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penjual_id">Penjual</label>
                                    <select name="penjual_id" id="penjual_id" class="form-control" required>
                                        @foreach ($penjuals as $penjual)
                                            <option value="{{ $penjual->id }}"
                                                {{ $sortir->penjual_id == $penjual->id ? 'selected' : '' }}>
                                                {{ $penjual->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn bg-maroon float-right">Update</button>
                                <a href="{{ route('sortirs.index') }}" class="btn btn-secondary ml-2">Kembali</a>
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
        document.getElementById('status').addEventListener('change', function() {
            const jangkosContainer = document.getElementById('jangkos-container');
            if (this.value === 'bagus') {
                jangkosContainer.style.display = 'block';
            } else {
                jangkosContainer.style.display = 'none';
            }
        });

        // Trigger the change event on page load to set the initial state
        document.getElementById('status').dispatchEvent(new Event('change'));

        document.getElementById('timbang_masuk').addEventListener('input', calculateBeratKotor);
        document.getElementById('timbang_keluar').addEventListener('input', calculateBeratKotor);
        document.getElementById('jangkos').addEventListener('input', calculateBeratKotor);

        function calculateBeratKotor() {
            const timbangMasuk = parseFloat(document.getElementById('timbang_masuk').value) || 0;
            const timbangKeluar = parseFloat(document.getElementById('timbang_keluar').value) || 0;
            const jangkos = parseFloat(document.getElementById('jangkos').value) || 0;
            const timbangKotor1 = timbangMasuk - timbangKeluar;
            const beratKotor = timbangKotor1 - jangkos;
            document.getElementById('berat_kotor').value = beratKotor.toFixed(0);
        }
    </script>
@endsection
