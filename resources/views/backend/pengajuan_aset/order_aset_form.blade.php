    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCard-{{ $index }}" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="collapseCard-{{ $index }}">
            <h6 class="m-0 font-weight-bold text-primary">Order Aset {{ $index + 1 }}</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCard-{{ $index }}" style="">
            <div class="card-body">
                <!-- Your aset_form fields go here, ensure the names have index placeholders, e.g. asset[{{ $index }}][fieldname] -->
                <div class="form-group mb-3">
                    <label class="form-label" for="aset_id-{{ $index }}">Nama Aset</label>
                    <select class="form-control" name="aset_id-{{ $index }}" id="aset_id-{{ $index }}">
                        @foreach ($aset as $value => $nama_aset)
                            <option value="{{ $value }}">{{ $nama_aset }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="jumlah-{{ $index }}">Jumlah Aset</label>
                    <input id="jumlah-{{ $index }}" type="text" class="form-control"
                        name="jumlah-{{ $index }}" value="" required
                        autocomplete="jumlah-{{ $index }}">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="harga-{{ $index }}">Total Harga Aset (Rp)</label>
                    <input id="harga-{{ $index }}" type="text" class="form-control"
                        name="harga-{{ $index }}" value="" required
                        autocomplete="harga-{{ $index }}">
                </div>
            </div>
        </div>
    </div>
