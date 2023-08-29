<?php $this->extend('pasien/template') ?>
<?php $this->section('content') ?>

<div class="container">
    <h2 class="text-center">
        <?= lang($lang . "Examination-Result") ?>
    </h2>
    <div class="row">
        <div class="d-flex justify-content-evenly flex-wrap">
            <?php foreach ($dataPemeriksaan as $row) : ?>
                <div class="card mt-2 mb-2" style="min-width: 300px; max-width: 400px;">
                    <div class="card-body">
                        <div class="card-title">
                            <h5><?= lang($lang . "Examination-Number") ?> : <?= $row->kd_pemeriksaan ?></h5>
                        </div>
                        <div class="card-subtitle mb-2 text-body-secondary">
                            <h6><?= lang($lang . "Name") ?> : <?= $row->username ?></h6>
                        </div>
                        <div class="card-text mb-1">
                            <p class="fw-bold"><?= lang($lang . "Diagnosys") ?> :</p>
                            <p class="text-truncate"><?= $row->hasil_periksa ?></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/pasien/detilResep/<?= $row->kd_pemeriksaan ?>/<?= $row->kd_resep ?>/<?= $row->username ?>" class="card-link"><?= lang($lang . "Recipe-Detil") ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php $this->endSection() ?>