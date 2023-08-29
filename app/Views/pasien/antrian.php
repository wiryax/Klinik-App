<?php $this->extend('pasien/template') ?>
<?php $this->section('content') ?>

<div class="container" style="width: 50%;">
    <div class="mt-5 mb-3 text-center">
        <h2><?= lang($lang . "Booking") ?></h2>
    </div>
    <?php if (session()->getFlashdata('statusBooking')) : ?>
        <div class="alert alert-success" role="alert">
            Data Berhasil Ditambahkan
        </div>
    <?php endif; ?>
    <?= (session()->getFlashdata('invlidTime')) ? '<div class="alert alert-warning" role="alert">' . session()->getFlashdata('invlidTime') . '</div>' : '' ?>

    <div class="row">
        <div class="col">
            <form action="/pasien/saveAntrian">
                <div class="mb-3">
                    <label for="tgl_periksa" class="form-label"><?= lang($lang . "Set-Date") ?> </label>
                    <input type="date" name="tgl_periksa" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class=" mb-3 text-center">
                <?php if (session()->getFlashdata('invalid-deleteAntrian')) : ?>
                    <div class="alert alert-info" role="alert">
                        <?= session()->getFlashdata('invalid-deleteAntrian') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('valid-deleteAntrian')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('valid-deleteAntrian') ?>
                    </div>
                <?php endif; ?>

                <h2><?= lang($lang . "Examination-List") ?></h2>
            </div>
            <div class="mb-3 table-responsive-sm">
                <table class="table text-center text-center align-middle">
                    <thead class="table-primary">
                        <tr class="">
                            <th>No.</th>
                            <th><?= lang($lang . "Name") ?></th>
                            <th><?= lang($lang . "Date") ?></th>
                            <th><?= lang($lang . "Diagnosys") ?></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($dataPemeriksaan as $row) : ?>
                            <tr>
                                <td class="vertical-align-middle"><?= $i++ ?></td>
                                <td class="vertical-align-middle"><?= session()->get('pasien') ?></td>
                                <td class="vertical-align-middle"><?= $row->tgl_periksa ?></td>
                                <td class="vertical-align-middle">
                                    <span class="d-inline-block text-truncate" style="max-width: 300px;">
                                        <p><?= $row->hasil_periksa ?></p>
                                    </span>
                                </td>
                                <td class="vertical-align-middle"><button class="btn btn-sm btn-block btn-danger d-1" data-bs-toggle="modal" data-bs-target="#<?= $row->kd_pemeriksaan ?>"><i class="bi bi-trash-fill"></i> Hapus</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
if (!empty($dataPemeriksaan)) :
    foreach ($dataPemeriksaan as $row) : ?>
        <div class="modal fade" id="<?= $row->kd_pemeriksaan ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda Yakin Untuk Menghapus Item Ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="/pasien/delete/<?= $row->kd_pemeriksaan ?>" class="btn btn-danger">Hapus Antrian</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    endforeach;
endif;
?>
<?php $this->endSection() ?>