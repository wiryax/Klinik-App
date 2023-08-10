<?php $this->extend('admin/template') ?>
<?php $this->section('content') ?>

<div class="container p-5">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <h2 class="text-center">Daftar Pembayaran</h2>
            </div>
            <?php if (session()->getFlashdata('invalidVerifikasi')) : ?>
                <div class="mb-3">
                    <div class="<?= session()->getFlashdata('invalidVerifikasiClass') ?>" role="alert">
                        <?= session()->getFlashdata('invalidVerifikasi') ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('validVerifikasi')) : ?>
                <div class="mb-3">
                    <div class="<?= session()->getFlashdata('validVerifikasiClass') ?>" role="alert">
                        <?= session()->getFlashdata('validVerifikasi') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr>
            <div class="input-group" style="width : 20vw;">
                <span class="input-group-text bg-transparent border-end-0" id="basic-addon1"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="search" aria-label="search" id="searchDataPembayaran">
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Transaksi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="data">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Box -->

<?php foreach ($dataPembayaran as $row) :  ?>
    <div class="modal fade" id="<?= $row->no_transaksi ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detil Biaya</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/verifPembayaran" method="post">
                        <div class="mb-3">
                            <label for="biaya" class="col-form-label">Total</label>
                            <input type="number" class="form-control" name="biaya" value="<?= $row->biaya ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="col-form-label">Nama Pasien</label>
                            <input type="text" class="form-control" name="username" value="<?= $row->username ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_transaksi" class="col-form-label">Bukti Transfer</label>
                            <img src="/img/bukti_pembayaran/<?= $row->file ?>" class="img-thumbnail">
                            <input type="text" class="form-control" name="no_transaksi" value="<?= $row->no_transaksi ?>" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="Submit" class="btn btn-primary">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- End Modal Box -->

<script>
    const tbody = document.getElementById("data")
    $.ajax({
        url: "<?= base_url('admin/getDataPembayaranAjax') ?>",
        method: "POST",
        success: (data) => {
            const dataPembayaran = JSON.parse(data)
            let i = 1
            if (data.length <= 0) {
                const tr = $('<tr></tr>')
                const td = $('<td></td>', {
                    "colspan": 5
                }).text("No Have Data")
                tbody.appendChild(tr)
                tr.appendChild(td)
            } else {
                dataPembayaran.forEach(element => {
                    const tr = document.createElement('tr')
                    const td_1 = document.createElement('td')
                    const td_2 = document.createElement('td')
                    const td_3 = document.createElement('td')
                    const td_4 = document.createElement('td')
                    const td_5 = document.createElement('td')

                    const badge = $("<span></span>", {
                        "class": "badge text-bg-success"
                    }).text(element.status).appendTo(td_4)
                    // const td_6 = document.createElement('td')

                    // td_6.appendChild(badge)

                    const btn = $('<button></button>', {
                        "class": ["btn btn-primary"],
                        "type": "button",
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#" + element.no_transaksi,
                        "disabled": element.status === "Menunggu" || element.status === "Lunas" ? true : false
                    }).text("Verifikasi").appendTo(td_5)

                    td_1.innerHTML = i
                    td_2.innerHTML = element.username
                    td_3.innerHTML = element.tgl
                    // td_5.innerHTML = element.no_transaksi
                    // td_6.innerHTML = element.kd_pasien

                    tbody.appendChild(tr)
                    tr.appendChild(td_1)
                    tr.appendChild(td_2)
                    tr.appendChild(td_3)
                    tr.appendChild(td_4)
                    tr.appendChild(td_5)
                    // tr.appendChild(td_6)
                    i++
                })
            }

        }
    })

    $('#searchDataPembayaran').keyup(() => {
        let data = $('#searchDataPembayaran').val()
        $.ajax({
            url: '<?= base_url('admin/getDataPembayaranAjax') ?>',
            method: 'POST',
            data: {
                searchDataPembayaran: data
            },
            success: function(data) {
                const dataPembayaran = JSON.parse(data)
                console.log(dataPembayaran)
                let i = 1
                $('#data').empty()
                if (data.length <= 0) {
                    const tr = $('<tr></tr>')
                    const td = $('<td></td>', {
                        "colspan": 5
                    }).text("No Have Data")
                    tbody.appendChild(tr)
                    tr.appendChild(td)
                } else {
                    dataPembayaran.forEach(element => {
                        const tr = document.createElement('tr')
                        const td_1 = document.createElement('td')
                        const td_2 = document.createElement('td')
                        const td_3 = document.createElement('td')
                        const td_4 = document.createElement('td')
                        const td_5 = document.createElement('td')

                        const badge = $("<span></span>", {
                            "class": "badge text-bg-success"
                        }).text(element.status).appendTo(td_4)
                        const btn = $('<button></button>', {
                            "class": ["btn btn-primary"],
                            "type": "button",
                            "data-bs-toggle": "modal",
                            "data-bs-target": "#" + element.no_transaksi,
                            "disabled": element.status === "Menunggu" || element.status === "Lunas" ? true : false
                        }).text("Verifikasi").appendTo(td_5)

                        td_1.innerHTML = i
                        td_2.innerHTML = element.username
                        td_3.innerHTML = element.tgl

                        tbody.appendChild(tr)
                        tr.appendChild(td_1)
                        tr.appendChild(td_2)
                        tr.appendChild(td_3)
                        tr.appendChild(td_4)
                        tr.appendChild(td_5)
                        i++
                    })
                }
            }

        })
    })
</script>
<?php $this->endSection() ?>