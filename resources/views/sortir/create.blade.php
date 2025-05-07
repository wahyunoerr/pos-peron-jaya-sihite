@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Create Sortir') }}</h1>
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
                            <h3>Form Create Sortir</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sortirs.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="timbang_masuk">Timbang Masuk</label>
                                    <div class="input-group">
                                        <input type="text" name="timbang_masuk" id="timbang_masuk" class="form-control"
                                            required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="timbang_keluar">Timbang Keluar</label>
                                    <div class="input-group">
                                        <input type="text" name="timbang_keluar" id="timbang_keluar" class="form-control"
                                            required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option disabled>-- Pilih ---</option>
                                        <option value="jelek">Jelek</option>
                                        <option value="bagus">Bagus</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control" required>
                                </div>
                                <div class="form-group" id="jangkos-container" style="display: none;">
                                    <label for="jangkos">Jongkos</label>
                                    <input type="text" name="jangkos" id="jangkos" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="berat_kotor">Berat Kotor</label>
                                    <div class="input-group">
                                        <input type="text" name="berat_kotor" id="berat_kotor" class="form-control"
                                            readonly required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="presentase_id">Presentase</label>
                                    <select name="presentase_id" id="presentase_id" class="form-control" required>
                                        @foreach ($presentases as $presentase)
                                            <option value="{{ $presentase->id }}">{{ $presentase->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penjual_id">Penjual</label>
                                    <select name="penjual_id" id="penjual_id" class="form-control" required>
                                        @foreach ($penjuals as $penjual)
                                            <option value="{{ $penjual->id }}">{{ $penjual->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn bg-maroon float-right">Submit</button>
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
