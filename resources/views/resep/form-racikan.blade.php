<form id="form-racik" class="row g-3">
    <div class="col-12">
        <table id="table-obatalkes-tambah" class="table table-sm table-responsive mb-2">
            <thead class="table-light">
                <tr style="font-size: 0.625rem">
                    <th class="px-2 py-1">#</th>
                    <th class="px-2 py-1">Obatalkes</th>
                    <th class="px-2 py-1">Signa</th>
                    <th class="px-2 py-1">Qty</th>
                </tr>
            </thead>

            <tbody style="font-size: 0.625rem">
            </tbody>
        </table>
    </div>

    <div id="list-obatalkes-tambah" class="col-12 border-top">
        <div class="row">
            <div class="col">
                <div class="mb-1">
                    <label class="form-label fs-6 mb-0">Obatalkes</label>
                    <select class="form-select form-select-sm" id="obatalkes_id" name="obatalkes_id" required>
                        <option selected disabled value="">Silahkan Pilih</option>
                        @foreach ($obatalkes as $oa)
                            <option value="{{ $oa->obatalkes_id }}">{{ $oa->obatalkes_nama }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Obatalkes harus diisi.</div>
                </div>
            </div>

            <div class="col">
                <div class="mb-1">
                    <label class="form-label fs-6 mb-0">Signa</label>
                    <select class="form-select form-select-sm" id="signa_id" name="signa_id" required>
                        <option selected disabled value="">Silahkan Pilih</option>
                        @foreach ($signa as $oa)
                            <option value="{{ $oa->signa_id }}">{{ $oa->signa_nama }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Signa harus diisi.</div>
                </div>
            </div>

            <div class="col-2">
                <div class="mb-2">
                    <label class="form-label fs-6 mb-0">Qty</label>
                    <input type="text" name="qty" id="qty" class="form-control form-control-sm" placeholder="Isi" required>
                    <div class="invalid-feedback">Isi.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="d-grid gap-2 d-flex justify-content-between">
            <button class="btn btn-primary" id="tambah-racikan" type="button">Simpan Racikan</button>
            <button class="btn btn-warning" id="tambah-obatalkes" type="button">Tambah Obatalkes</button>
        </div>
    </div>
</form>
