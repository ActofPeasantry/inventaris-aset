<div class="form-group mb-3">
    <label class="form-label" for="aset_id">Nama Aset</label>
    <select class="form-control" name="aset_id" id="aset_id" required>
        @foreach ($aset_data as $aset)
            <option value="{{ $aset->id }}">{{ $aset->kode_aset }} | {{ $aset->nama_aset }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-mb-3">
    <label class="form-label" for="jumlah_aset_rusak">Jumlah Aset Rusak</label>
    <input id="jumlah_aset_rusak" type="text" class="form-control" name="jumlah_aset_rusak" value="" required
        autocomplete="jumlah_aset_rusak">
</div>

<input type="hidden" id="old_jumlah_aset_rusak" name="old_jumlah_aset_rusak" value="">
