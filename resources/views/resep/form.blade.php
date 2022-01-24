@extends('layouts.app')

@push('script_inline')
    <script>
        const loadingTambahObat = () => {
            return `
                <div class="d-flex justify-content-center align-items-center my-5">
                    <div class="spinner-border role="status" aria-hidden="true"></div>
                    <strong>&nbsp; Tunggu sebentar...</strong>
                </div>
            `
        }

        const formContentTambahObat = (url) => {
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
            })
            .then(response => response.json())
            .then(data => {
                let tipeObat = document.getElementById("tipe-obat")

                document.getElementById("content-tipe-obat").innerHTML = data

                // -------------------------------------------------------------------

                if (tipeObat.options[tipeObat.selectedIndex].getAttribute('data-id') == 2) {
                    document.getElementById("tambah-obatalkes").addEventListener("click", function(e) {
                        e.preventDefault();

                        let tableTambah = document.getElementById("table-obatalkes-tambah").getElementsByTagName('tbody')[0],
                            rowTambah = tableTambah.insertRow(-1),
                            obatalkes_id = document.getElementById("obatalkes_id").options[document.getElementById("obatalkes_id").selectedIndex],
                            signa_id = document.getElementById("signa_id").options[document.getElementById("signa_id").selectedIndex]

                        rowTambah.insertCell(0).innerHTML = tableTambah.rows.length
                        rowTambah.insertCell(1).innerHTML = obatalkes_id.text
                        rowTambah.insertCell(2).innerHTML = signa_id.text
                        rowTambah.insertCell(3).innerHTML = document.getElementById("qty").value

                        document.getElementById("qty").value = ""
                        document.getElementById("obatalkes_id").selectedIndex = 0
                        document.getElementById("signa_id").selectedIndex = 0
                    });
                }

                // -------------------------------------------------------------------

                if (tipeObat.options[tipeObat.selectedIndex].getAttribute('data-id') == 2) {
                    document.getElementById("tambah-racikan").addEventListener("click", function(e) {
                        e.preventDefault();

                        let tableTambah = document.getElementById("table-obatalkes-tambah").getElementsByTagName('tbody')[0]

                        if (tableTambah.rows.length) {
                            let table = document.getElementById("list-obat").getElementsByTagName('tbody')[0],
                                row = table.insertRow(-1),
                                row2 = table.insertRow(-1);

                            formContentTambahObat(url)

                            row.insertCell(0).innerHTML = tableTambah.rows.length
                            row.insertCell(1).innerHTML = 'Obat Racikan '+tableTambah.rows.length
                            row.insertCell(2).innerHTML = '-'
                            row.insertCell(3).innerHTML = '-'

                            row2.insertCell(0).innerHTML = ''
                            row2.insertCell(1).innerHTML = 'Obat Racikan '+tableTambah.rows.length
                            row2.insertCell(2).innerHTML = '-'
                            row2.insertCell(3).innerHTML = '-'
                        }
                    });
                } else {
                    var forms = document.querySelectorAll('.needs-validation')

                    Array.prototype.slice.call(forms).forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            event.preventDefault()
                            event.stopPropagation()

                            form.classList.add('was-validated')

                            if (form.checkValidity()) {
                                formContentTambahObat(url)
                                form.querySelector('button[type="submit"]').disabled = true

                                let table = document.getElementById("list-obat").getElementsByTagName('tbody')[0],
                                    row = table.insertRow(-1);

                                formContentTambahObat(url)

                                let obatalkes_id = form.elements["obatalkes_id"].options[form.elements["obatalkes_id"].selectedIndex],
                                    signa_id = form.elements["signa_id"].options[form.elements["signa_id"].selectedIndex]

                                row.id = JSON.stringify({
                                    tipe_obat: tipeObat.options[tipeObat.selectedIndex].getAttribute('data-id'),
                                    obatalkes_id: obatalkes_id.value,
                                    signa_id: signa_id.value,
                                    qty: form.elements["qty"].value
                                })
                                row.insertCell(0).innerHTML = table.rows.length
                                row.insertCell(1).innerHTML = obatalkes_id.text
                                row.insertCell(2).innerHTML = signa_id.text
                                row.insertCell(3).innerHTML = form.elements["qty"].value
                            }
                        }, false)
                    })
                }
            })
            .catch((error) => {
                formContentTambahObat(url)
                console.log(error);
            });
        }

        document.getElementById("resep-save").addEventListener("click", function(e) {
            e.preventDefault();

            let table = document.getElementById("list-obat").getElementsByTagName('tbody')[0]

            if (table.rows.length) {
                let data = [];

                for (let row of table.rows)
                {
                    data.push(JSON.parse(row.id));
                }

                const href    = e.target.closest('a').getAttribute('href'),
                      headers = {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                      };

                fetch(href, {
                    method: 'POST',
                    headers: headers,
                    body: JSON.stringify({ obat: data }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert('Resep berhasil dibuat.')
                })
                .catch((error) => {
                    console.log(error);
                    alert('Resep gagal dibuat.')
                });
            }
        });

        document.getElementById("tipe-obat").addEventListener("change", function(e) {
            const action = e.target[event.target.selectedIndex].value;

            document.getElementById("content-tipe-obat").innerHTML = loadingTambahObat()

            formContentTambahObat(action)
        });

        document.getElementById("content-tipe-obat").innerHTML = loadingTambahObat()

        formContentTambahObat("{{ $selectNonRacikan }}")
    </script>
@endpush

@section('content')
    <h1 class="text-center mb-4">Form Buat Resep</h1>

    <div class="row">
        <div class="col">
            <figcaption class="blockquote-footer mt-0 mb-1">
                <cite title="Source Title">Silahkan Tambah Obat terlebih dahulu sebelum Simpan Resep !!!</cite>
            </figcaption>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header px-2 py-1">
                    List Obat
                </div>

                <div class="card-body px-2 py-1">
                    <table id="list-obat" class="table table-sm table-responsive mb-2">
                        <thead class="table-light">
                            <tr>
                                <th class="px-2 py-1">#</th>
                                <th class="px-2 py-1">Obatalkes</th>
                                <th class="px-2 py-1">Signa</th>
                                <th class="px-2 py-1">Qty</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer px-2 py-2">
                    <a href="{{ route('resep.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <a href="{{ $urlStore }}" id="resep-save" class="btn btn-success">Simpan Resep</a>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header px-2 py-1">Tambah Obat</div>

                <div class="card-body px-2 py-1">
                    <div class="mb-2 pb-2 border-bottom">
                        <label for="tipe-obat" class="form-label fs-6 mb-0">Tipe Obat</label>
                        <select class="form-select form-select-sm" id="tipe-obat">
                            <option selected value="{{ $selectNonRacikan }}" data-id="1">Non Racikan</option>
                            <option value="{{ $selectRacikan }}" data-id="2">Racikan</option>
                        </select>
                    </div>

                    <div id="content-tipe-obat" class="mb-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
