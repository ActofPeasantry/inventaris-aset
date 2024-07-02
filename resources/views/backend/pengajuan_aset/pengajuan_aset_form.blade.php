<div class="form-group mb-3">
    <label class="form-label" for="tujuan_transaksi">Tujuan Transaksi</label>
    <select class="form-control" name="tujuan_transaksi" id="tujuan_transaksi">
        <option value="pengaadaan aset baru">Pengadaan Aset Baru</option>
        <option value="pengaduan aset rusak" selected>Pengaduan Aset Rusak</option>
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
