<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Pabrik</th>
            <th>Sortir ID</th>
            <th>Harga Jual</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detailTransaksis as $detail)
            <tr>
                <td>{{ $detail->nama_pabrik }}</td>
                <td>{{ $detail->sortir_id }}</td>
                <td>Rp. {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
