<?php $this->extend('admin/template') ?>
<?php $this->section('content') ?>

<div class="container p-5">
    <!-- <h2 class="text-center">
        Laporan
    </h2> -->
    <div class="row mb-3">
        <div class="col">
            <div class="mb-3">
                <h4 class="">Laporan Data Pasien</h4>
            </div>
            <div class="mb-3">
                <a href="/admin/cetakDataPasien" class="btn btn-primary" style="width: 100px;"><i class="bi bi-printer-fill"></i> Cetak</a>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>Nomer Telphone</th>
                        <th>Kode Resep</th>
                        <th>Tanggal Pemeriksaan</th>
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
                <h4 class="">Laporan Pembayaran</h4>
            </div>
            <div class="mb-3">
                <a href="/admin/cetakPembayaran" class="btn btn-primary" style="width: 100px;"><i class="bi bi-printer-fill"></i> Cetak</a>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Kode Pemeriksaan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Biaya</th>
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
                <h4 class="">Laporan Data Diagnosa</h4>
            </div>
            <div class="mb-3">
                <a href="/admin/cetakDataDiagnosa" class="btn btn-primary" style="width: 100px;"><i class="bi bi-printer-fill"></i> Cetak</a>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Periksa</th>
                        <th>Hasil Diagnosa</th>
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