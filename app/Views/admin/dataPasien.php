<?php $this->extend('admin/template') ?>
<?php $this->section('content') ?>
<div class="mb-5 text-center">
    <h2><?= lang($lang . "List-Patient") ?></h2>
    <hr>
    <?php if (!empty($validation['kd_obat'])) : ?>
        <div class="mb-3">
            <div class="alert alert-warning" role="alert">
                <?= $validation['kd_obat'] ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($validation['hasil_periksa'])) : ?>
        <div class="mb-3">
            <div class="alert alert-warning" role="alert">
                <?= $validation['hasil_periksa'] ?>
            </div>
        </div>
    <?php endif; ?>
    <?= (session()->getFlashdata('saveDiagnosis')) ? '<div class="mb-3">
                        <div class="alert alert-success" role="alert">
                            ' . session()->getFlashdata('saveDiagnosis') . '</div></div>' : ""
    ?>
</div>
<div id="test">

</div>
<div class="input-group" style="width : 20vw;">
    <span class="input-group-text bg-transparent border-end-0" id="basic-addon1"><i class="bi bi-search"></i></span>
    <input type="text" class="form-control border-start-0" placeholder="search" aria-label="search" id="search">
</div>
<div class="table-responsive-sm ">
    <table class="table text-center align-middle">
        <thead>
            <tr>
                <th>No.</th>
                <th><?= lang($lang . "Examination-Number") ?></th>
                <th><?= lang($lang . "Name") ?></th>
                <th><?= lang($lang . "Date") ?></th>
                <!-- <th>Status Pembayaran</th> -->
                <th><?= lang($lang . "Examination") ?></th>
            </tr>
        </thead>
        <tbody id="data">

        </tbody>
    </table>
</div>

<!-- Modal -->
<?php foreach ($dataPasien as $row) : ?>
    <div class="modal fade" id="<?= $row->kd_pemeriksaan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Hasil Diagnosa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/saveDiagnosis" method="post">
                        <div class="mb-3">
                            <label for="kd_pemeriksaan" class="col-form-label">Kode Pasien</label>
                            <input type="text" class="form-control" readonly value="<?= $row->kd_pemeriksaan ?>" name="kd_pemeriksaan">
                        </div>
                        <div class="mb-3">
                            <label for="kd_pasien" class="col-form-label">Kode Pasien</label>
                            <input type="text" class="form-control" readonly value="<?= $row->kd_pasien ?>" name="kd_pasien">
                        </div>
                        <div class="mb-3 ">
                            <?php foreach ($dataObat as $row) : ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="<?= $row->kd_obat ?>" name="kd_obat[]">
                                    <label class="form-check-label" for="kd_obat">
                                        <?= $row->nama_obat ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Hasil Pemeriksaan:</label>
                            <textarea class="form-control" id="message-text" name="hasil_periksa"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    const tbody = document.getElementById('data')

    $.ajax({
        url: '<?= base_url('admin/getDataAjax') ?>',
        method: 'POST',
        success: function(data) {
            let i = 1
            const dataPasien = JSON.parse(data)
            if (dataPasien.length <= 0) {
                const tr = document.createElement('tr')
                const td = document.createElement('td')
                td.setAttribute('colspan', "5")
                td.innerHTML = "No Have Data"
                tbody.appendChild(tr)
                tr.appendChild(td)
            }
            dataPasien.forEach(element => {

                const tr = $('<tr></tr>').appendTo(tbody)
                const td_1 = $('<td></td>', {
                    class: ['vertical-align-middle']
                }).text(i).appendTo(tr)
                const td_2 = $('<td></td>', {
                    class: ['align-self-center']
                }).text(element.kd_pemeriksaan).appendTo(tr)
                const td_3 = $('<td></td>', {
                    class: ['vertical-align-middle']
                }).text(element.username).appendTo(tr)
                const td_4 = $('<td></td>', {
                    class: ['vertical-align-middle']
                }).text(element.tgl_periksa).appendTo(tr)
                const td_5 = $('<td></td>', {
                    class: ['vertical-align-middle']
                }).appendTo(tr)

                const btn = $('<button></button>', {
                    "class": ["btn btn-primary"],
                    "type": "button",
                    "data-bs-toggle": "modal",
                    "data-bs-target": "#" + element.kd_pemeriksaan,
                    "disabled": element.status === "Lunas" || element.status === "Menunggu Verifikasi" ? true : false
                }).text("Input Hasil Pemeriksaan").appendTo(td_5)
                i += 1
            });
        }
    })

    $('#search').keyup(() => {
        let data = $('#search').val()
        $.ajax({
            url: '<?= base_url('admin/getDataAjax') ?>',
            method: 'POST',
            data: {
                search: data
            },
            success: function(data) {
                let j = 1
                $('#data').empty()
                const dataPasien = JSON.parse(data)
                if (dataPasien.length <= 0) {
                    const tr = $('<tr></tr>').appendTo(tbody)
                    const td = $('<td></td>', {
                        "colspan": 5,
                    }).text("No Have Data").appendTo(tr)
                }
                dataPasien.forEach(element => {
                    const tr = document.createElement('tr')
                    const td_1 = document.createElement('td')
                    const td_2 = document.createElement('td')
                    const td_3 = document.createElement('td')
                    const td_4 = document.createElement('td')
                    const td_5 = document.createElement('td')

                    const btn = $('<button></button>', {
                        "class": ["btn btn-primary"],
                        "type": "button",
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#" + element.kd_pemeriksaan,
                        "disabled": element.status === "Lunas" || element.status === "Menunggu Verifikasi" ? true : false
                    }).text("Input Hasil Pemeriksaan").appendTo(td_5)

                    tbody.appendChild(tr)
                    tr.appendChild(td_1)
                    tr.appendChild(td_2)
                    tr.appendChild(td_3)
                    tr.appendChild(td_4)
                    tr.appendChild(td_5)

                    td_1.innerHTML = j
                    td_2.innerHTML = element.kd_pemeriksaan
                    td_3.innerHTML = element.username
                    td_4.innerHTML = element.tgl_periksa
                    j += 1
                });
            }

        })
    })
</script>
<?php $this->endSection() ?>