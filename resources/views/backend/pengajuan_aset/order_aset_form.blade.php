<div class="order-aset-form-template">
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
                    <label class="form-label" for="aset[{{ $index }}][aset_id]">Nama Aset</label>
                    <select class="form-control" name="aset[{{ $index }}][aset_id]"
                        id="aset[{{ $index }}][aset_id]">
                        @foreach ($aset as $value => $nama_aset)
                            <option value="{{ $value }}">{{ $nama_aset }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="aset[{{ $index }}][jumlah]">Jumlah Aset</label>
                    <input id="aset[{{ $index }}][jumlah]" type="text" class="form-control"
                        name="aset[{{ $index }}][jumlah]" value="" required
                        autocomplete="aset[{{ $index }}][jumlah]">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="aset[{{ $index }}][jumlah]">Total Harga Aset (Rp)</label>
                    <input id="aset[{{ $index }}][harga]" type="text" class="form-control"
                        name="aset[{{ $index }}][harga]" value="" required
                        autocomplete="aset[{{ $index }}][harga]">
                </div>
            </div>
        </div>
    </div>




</div>
