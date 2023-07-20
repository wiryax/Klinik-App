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
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($dataPembayaran as $row) :
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->username ?></td>
                            <td><?= $row->tgl ?></td>
                            <td><span class="badge text-bg-success"><?= $row->status ?></span></td>
                            <td><button type="button" class="btn btn-primary <?= ($row->status === 'Lunas' || $row->status === 'Menunggu') ? 'disabled' : ''; ?>" data-bs-toggle="modal" data-bs-target="#<?= $row->no_transaksi ?>" data-bs-whatever="@getbootstrap">Verifikasi</button></td>
                        </tr>
                    <?php
                        $i++;
                    endforeach; ?>
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

<?php $this->endSection() ?>