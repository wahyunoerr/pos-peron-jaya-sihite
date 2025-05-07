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
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
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

            addToCartButton.addEventListener('click', function() {
                const selectedOption = sortirSelect.options[sortirSelect.selectedIndex];
                if (selectedOption && selectedOption.value) {
                    // Add to keranjang
                    const listItem = document.createElement('li');
                    listItem.className =
                        'list-group-item d-flex justify-content-between align-items-center';
                    listItem.textContent = selectedOption.text;
                    listItem.setAttribute('data-id', selectedOption.value);
                    listItem.setAttribute('data-harga', selectedOption.getAttribute('data-harga'));

                    // Add remove button
                    const removeButton = document.createElement('button');
                    removeButton.className = 'btn btn-danger btn-sm';
                    removeButton.textContent = 'Hapus';
                    removeButton.addEventListener('click', function() {
                        // Remove from keranjang
                        keranjang.removeChild(listItem);

                        // Add back to dropdown
                        sortirSelect.appendChild(selectedOption);

                        // Update hidden input and jumlah transaksi
                        updateSelectedSortirIds();
                        updateJumlahTransaksi();
                    });

                    listItem.appendChild(removeButton);
                    keranjang.appendChild(listItem);

                    // Remove from dropdown
                    sortirSelect.removeChild(selectedOption);

                    // Update hidden input and jumlah transaksi
                    updateSelectedSortirIds();
                    updateJumlahTransaksi();
                }
            });

            function updateSelectedSortirIds() {
                const selectedIds = Array.from(keranjang.children).map(item => item.getAttribute('data-id'));
                selectedSortirIds.value = selectedIds.join(',');
            }

            function updateJumlahTransaksi() {
                const totalItems = keranjang.children.length; // Count the number of items in the cart
                jumlahTransaksiInput.value = totalItems; // Set jumlah_transaksi to the count of items
            }
        });
    </script>
@endsection
