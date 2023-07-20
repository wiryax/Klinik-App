<?php $this->extend('admin/template') ?>
<?php $this->section('content') ?>
<div class="container p-5">
    <div class="row">
        <div class="col">
            <div class="mb-5 text-center">
                <?php
                // if (validation_errors()) {
                //     d(validation_errors()["kd_obat"]);
                // } else {
                //     echo false;
                // }
                ?>
                <h2>List Pasien</h2>
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
                            ' . session()->getFlashdata('saveDiagnosis') . '</div></div>' : "" ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Pemeriksaan</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Pemeriksaan</th>
                            <!-- <th>Status Pembayaran</th> -->
                            <th>Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($dataPasien as $row) :
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row->kd_pemeriksaan ?></td>
                                <td><?= $row->username ?></td>
                                <td><?= $row->tgl_periksa ?></td>
                                <!-- <td><span class="badge text-bg-success"></span></td> -->
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $row->kd_pemeriksaan ?>" data-bs-whatever="@mdo" <?= ($row->status = 'menunggu') ? '' : 'disabled';  ?>>Input Hasil Pemeriksaan</button></td>
                                <!-- <td><a href="/" class="btn btn-primary">Detil Resep</a></td> -->
                            </tr>
                        <?php
                            $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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

<?php $this->endSection() ?>