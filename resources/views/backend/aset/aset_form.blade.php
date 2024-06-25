<div class="form-group col-mb-3">
    <label class="form-label" for="kode_aset">Kode Aset</label>
    <input id="kode_aset" type="text" class="form-control" name="kode_aset" value="" required
        autocomplete="kode_aset">
</div>

<div class="form-group col-mb-3">
    <label class="form-label" for="nama_aset">Nama Aset</label>
    <input id="nama_aset" type="text" class="form-control" name="nama_aset" value="" required
        autocomplete="nama_aset">
</div>

<div class="form-group col-mb-3">
    <label class="form-label" for="deskripsi_aset">Deskripsi Aset</label>
    <input id="deskripsi_aset" type="text" class="form-control" name="deskripsi_aset" value="" required
        autocomplete="deskripsi_aset">
</div>

<div class="form-group mb-3">
    <label class="form-label" for="kategori_aset_id">Kategori Aset</label>
    <select class="form-control" name="kategori_aset_id" id="kategori_aset_id">
        @foreach ($kategori_data as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
        @endforeach
    </select>
</div>
