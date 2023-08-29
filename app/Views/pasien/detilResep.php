<?php $this->extend('pasien/template') ?>
<?php $this->section('content') ?>

<div class="container">
    <h2 class="text-center">
        <?= lang($lang . "Recipe-Detil") ?>
    </h2>
    <div class="row">
        <div class="col">
            <div class="table-responsive-sm">
                <table class="table table-hover align-middle">
                    <tr class="table-secondary">
                        <th><?= lang($lang . "Examination-Number") ?></th>
                        <td><?= $dataPeriksa[0]->kd_pemeriksaan ?></td>
                    </tr>
                    <tr class="table-light">
                        <th><?= lang($lang . "Name") ?></th>
                        <td><?= $nama_pasien ?></td>
                    </tr>
                    <tr class="table-secondary">
                        <th>Obat Yang Harus Dikonsumsi</th>
                        <td><?php foreach ($dataObat as $row) :  ?>
                                <?= $row->nama_obat ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr class="table-light">
                        <th><?= lang($lang . "Examination-Result") ?></th>
                        <td>
                            <?= $dataPeriksa[0]->hasil_periksa ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>