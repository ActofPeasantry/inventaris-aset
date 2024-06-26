<div class="form-group mb-3">
    <label class="form-label" for="tujuan_transaksi">Tujuan Transaksi</label>
    <select class="form-control" name="tujuan_transaksi" id="tujuan_transaksi">
        <option value="aset tetap">Pengadaan aset baru</option>
        <option value="aset tetap">Pengaduan aset rusak</option>
    </select>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="supplier_id">Supplier</label>
    <select class="form-control" name="supplier_id" id="supplier_id">
        @foreach ($supplier as $value => $nama_supplier)
            <option value="{{ $value }}">{{ $nama_supplier }}</option>
        @endforeach
    </select>
</div>
