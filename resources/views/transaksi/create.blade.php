@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Transaksi</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Form Create Transaksi</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaksis.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="kode_transaksi">Kode Transaksi</label>
                                    <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control"
                                        value="{{ 'TRX-' . now()->timestamp }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                                        class="form-control" value="{{ now()->toDateString() }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_transaksi">Jumlah Transaksi</label>
                                    <input type="number" name="jumlah_transaksi" id="jumlah_transaksi" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="details">Detail Transaksi</label>
                                    <input type="hidden" name="details" id="details">
                                </div>
                                <div class="form-group">
                                    <label for="sortir_ids">Pilih Sawit dari Sortir</label>
                                    <select id="sortir_ids" class="form-control">
                                        @foreach ($sortirs as $sortir)
                                            <option value="{{ $sortir->id }}" data-harga="{{ $sortir->harga }}">
                                                {{ $sortir->timbangan_bersih }}kg - {{ $sortir->penjual->name }} -
                                                {{ $sortir->status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="sortir_ids" id="selected_sortir_ids">
                                <button type="button" id="addToCart" class="btn btn-primary">Pilih Sortir</button>
                                <div class="form-group">
                                    <label>Sawit Yang Dipilih untuk dijual</label>
                                    <ul id="keranjang" class="list-group">
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual /kg</label>
                                    <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="total_harga_jual">Total Harga Jual</label>
                                    <input type="text" id="total_harga_jual" class="form-control" disabled>
                                    <input type="hidden" name="total_harga_jual" id="total_harga_jual_hidden">
                                </div>
                                <div class="form-group">
                                    <label for="supir_id">Pilih Supir</label>
                                    <select name="supir_id" id="supir_id" class="form-control" required>
                                        @foreach ($supirs as $supir)
                                            <option value="{{ $supir->id }}">{{ $supir->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="upah_supir">Upah Supir</label>
                                    <input type="number" name="upah_supir" id="upah_supir" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Kerusakan</label>
                                    <div id="kerusakan-list">
                                        <div class="kerusakan-item mb-2">
                                            <input type="text" name="nama_kerusakan[]"
                                                class="form-control d-inline-block w-50" placeholder="Nama Kerusakan"
                                                autocomplete="off">
                                            <input type="number" name="biaya_kerusakan[]"
                                                class="form-control d-inline-block w-25" placeholder="Biaya"
                                                autocomplete="off">
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-kerusakan">Hapus</button>
                                        </div>
                                    </div>
                                    <button type="button" id="add-kerusakan" class="btn btn-success btn-sm mt-2">Tambah
                                        Kerusakan</button>
                                    <small class="form-text text-muted">Boleh dikosongkan jika tidak ada kerusakan.</small>
                                </div>
                                <div class="form-group">
                                    <label for="nama_pabrik">Nama Pabrik</label>
                                    <input type="text" name="nama_pabrik" id="nama_pabrik" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn bg-maroon float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortirSelect = document.getElementById('sortir_ids');
            const keranjang = document.getElementById('keranjang');
            const selectedSortirIds = document.getElementById('selected_sortir_ids');
            const addToCartButton = document.getElementById('addToCart');
            const jumlahTransaksiInput = document.getElementById('jumlah_transaksi');
            const hargaJualInput = document.getElementById('harga_jual');
            const totalHargaJualInput = document.getElementById('total_harga_jual');

            addToCartButton.addEventListener('click', function() {
                const selectedOption = sortirSelect.options[sortirSelect.selectedIndex];
                if (selectedOption && selectedOption.value) {
                    const listItem = document.createElement('li');
                    listItem.className =
                        'list-group-item d-flex justify-content-between align-items-center';
                    listItem.textContent = selectedOption.text;
                    listItem.setAttribute('data-id', selectedOption.value);
                    listItem.setAttribute('data-harga', selectedOption.getAttribute('data-harga'));
                    listItem.setAttribute('data-kg', selectedOption.text.split('kg')[0].trim());

                    const removeButton = document.createElement('button');
                    removeButton.className = 'btn btn-danger btn-sm';
                    removeButton.textContent = 'Hapus';
                    removeButton.addEventListener('click', function() {
                        keranjang.removeChild(listItem);
                        sortirSelect.appendChild(selectedOption);
                        updateSelectedSortirIds();
                        updateJumlahTransaksi();
                        updateTotalHargaJual();
                    });

                    listItem.appendChild(removeButton);
                    keranjang.appendChild(listItem);
                    sortirSelect.removeChild(selectedOption);
                    updateSelectedSortirIds();
                    updateJumlahTransaksi();
                    updateTotalHargaJual();
                }
            });

            hargaJualInput.addEventListener('input', updateTotalHargaJual);

            function updateSelectedSortirIds() {
                const selectedIds = Array.from(keranjang.children).map(item => item.getAttribute('data-id'));
                selectedSortirIds.value = selectedIds.join(',');
            }

            function updateJumlahTransaksi() {
                const totalItems = keranjang.children.length;
                jumlahTransaksiInput.value = totalItems;
            }

            function updateTotalHargaJual() {
                const hargaJual = parseFloat(hargaJualInput.value) || 0;
                let totalKg = 0;

                Array.from(keranjang.children).forEach(item => {
                    const kg = parseFloat(item.getAttribute('data-kg')) || 0;
                    totalKg += kg;
                });

                const totalHargaJual = totalKg * hargaJual;
                totalHargaJualInput.value = totalHargaJual.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
                document.getElementById('total_harga_jual_hidden').value = totalHargaJual;
            }

            document.getElementById('add-kerusakan').addEventListener('click', function() {
                const container = document.createElement('div');
                container.className = 'kerusakan-item mb-2';
                container.innerHTML = `
                    <input type="text" name="nama_kerusakan[]" class="form-control d-inline-block w-50" placeholder="Nama Kerusakan">
                    <input type="number" name="biaya_kerusakan[]" class="form-control d-inline-block w-25" placeholder="Biaya">
                    <button type="button" class="btn btn-danger btn-sm remove-kerusakan">Hapus</button>
                `;
                document.getElementById('kerusakan-list').appendChild(container);
            });
            document.getElementById('kerusakan-list').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-kerusakan')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
@endsection
