<?php $this->extend('admin/template') ?>
<?php $this->section('content') ?>

<div class="container p-5">
    <!-- <h2 class="text-center">
        Laporan
    </h2> -->
    <div class="row mb-3">
        <div class="col">
            <div class="mb-3">
                <h4 class=""><?= lang($lang . "Report") ?></h4>
            </div>
            <div class="mb-3">
                <a href="/admin/cetakDataPasien" class="btn btn-primary" style="width: 100px;"><i class="bi bi-printer-fill"></i><?= lang($lang . "Print") ?></a>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th><?= lang($lang . "Name") ?></th>
                        <th><?= lang($lang . "Addres") ?></th>
                        <th><?= lang($lang . "Phone") ?></th>
                        <th><?= lang($lang . "Recipe-Number") ?></th>
                        <th><?= lang($lang . "Date") ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($lap_pasien as $row) :
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->username ?></td>
                            <td><?= $row->alamat ?></td>
                            <td><?= $row->no_tlp ?></td>
                            <td><?= $row->kd_resep ?></td>
                            <td><?= $row->tgl_periksa ?></td>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="mb-3">
                <h4 class=""><?= lang($lang . "Report") ?></h4>
            </div>
            <div class="mb-3">
                <a href="/admin/cetakPembayaran" class="btn btn-primary" style="width: 100px;"><i class="bi bi-printer-fill"></i><?= lang($lang . "Print") ?></a>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th><?= lang($lang . "Transaction-Number") ?></th>
                        <th><?= lang($lang . "Date") ?></th>
                        <th><?= lang($lang . "Payment-Date") ?></th>
                        <th><?= lang($lang . "Cost") ?></th>
                        <th><?= lang($lang . "Payment-Status") ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($lap_pembayaran as $row) :
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->username ?></td>
                            <td><?= $row->tgl_periksa ?></td>
                            <td><?= $row->tgl ?></td>
                            <td><?= $row->biaya ?></td>
                            <td><?= $row->status ?></td>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="mb-3">
                <h4 class=""><?= lang($lang . "Report") . lang($lang . "Diagnosys") ?></h4>
            </div>
            <div class="mb-3">
                <a href="/admin/cetakDataDiagnosa" class="btn btn-primary" style="width: 100px;"><i class="bi bi-printer-fill"></i> Cetak</a>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th><?= lang($lang . "Name") ?></th>
                        <th><?= lang($lang . "Date") ?></th>
                        <th><?= lang($lang . "Diagnosys") ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($lap_diagnosa as $row) :
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->username ?></td>
                            <td><?= $row->tgl_periksa ?></td>
                            <td><?= $row->hasil_periksa ?></td>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->endSection() ?>