<?php $this->extend('pasien/template') ?>
<?php $this->section('content') ?>

<div class="container p-5 position-absolute top-50 start-50 translate-middle" style="width: 40%;">
    <h2 class="text-center">
        Detil Resep
    </h2>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Kode Pemeriksaan : <?= $dataPeriksa[0]->kd_pemeriksaan ?>
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <p><span class="fw-bold">Nama Pasien : </span><?= $nama_pasien ?></p>
                        <p class="fw-bold">Keterangan :</p>
                        <p><?= $dataPeriksa[0]->hasil_periksa ?></p>
                        <p class="fw-bold">Daftar Obat :</p>
                        <ul class="list-group list-group-horizontal">
                            <?php foreach ($dataObat as $row) :  ?>
                                <li class="list-group-item"><?= $row->nama_obat ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>