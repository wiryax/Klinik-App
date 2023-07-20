<?php $this->extend('admin/template') ?>
<?php $this->section('content') ?>
<div class="container p-5">
    <div class="row">
        <h1 class="text-center">Masukan</h1>
        <table class="table text-center">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Perihal</th>
                    <th>Masukan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($dataMasukan)) {  ?>
                    <tr>
                        <td colspan="4" class="h4">Data Masukan Tidak Ada</td>
                    </tr>
                    <?php
                } else {
                    $i = 1;
                    foreach ($dataMasukan as $row) {
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->username ?></td>
                            <td><?= $row->perihal ?></td>
                            <td><?= $row->pesan ?></td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->endSection() ?>