<form class="row g-3 needs-validation" novalidate>
    <div class="mb-1">
        <label for="obatalkes_id" class="form-label fs-6 mb-0">Obatalkes</label>
        <select class="form-select form-select-sm" id="obatalkes_id" name="obatalkes_id" required>
            <option selected disabled value="">Silahkan Pilih</option>
            @foreach ($obatalkes as $oa)
                <option value="{{ $oa->obatalkes_id }}">{{ $oa->obatalkes_nama }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">Obatalkes harus diisi.</div>
    </div>

    <div class="mb-1">
        <label for="signa_id" class="form-label fs-6 mb-0">Signa</label>
        <select class="form-select form-select-sm" id="signa_id" name="signa_id" required>
            <option selected disabled value="">Silahkan Pilih</option>
            @foreach ($signa as $oa)
                <option value="{{ $oa->signa_id }}">{{ $oa->signa_nama }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">Signa harus diisi.</div>
    </div>

    <div class="mb-2">
        <label for="qty" class="form-label fs-6 mb-0">Qty</label>
        <input type="text" name="qty" id="qty" class="form-control form-control-sm" placeholder="Silahkan isi" required>
        <div class="invalid-feedback">Qty harus diisi.</div>
    </div>

    <div class="col-12">
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Tambah</button>
        </div>
    </div>
</form>
