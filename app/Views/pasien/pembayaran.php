<?php $this->extend('pasien/template') ?>
<?php $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center mb-5">
                Transaksi
            </h2>
            <?php if (session()->getFlashdata('invalidPembayaran')) : ?>
                <div class="mb-5">
                    <div class="<?= session()->getFlashdata('invalidPembayaranClass') ?>" role="alert">
                        <?= session()->getFlashdata('invalidPembayaran') ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('validPembayaran')) : ?>
                <div class="mb-5">
                    <div class="<?= session()->getFlashdata('validPembayaranClass') ?>" role="alert">
                        <?= session()->getFlashdata('validPembayaran') ?>
                    </div>
                </div>
            <?php endif; ?>
            <table class="table align-middle text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($dataPembayaran)) { ?>
                        <tr>
                            <td colspan="4" class="h4">Tidak Ada Data Pembayaran</td>
                        </tr>
                    <?php } else { ?>
                        <?php
                        $i = 1;
                        foreach ($dataPembayaran as $row) :
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row->tgl ?></td>
                                <td>
                                    <div class="badge text-bg-success"><?= $row->status ?></div>
                                </td>
                                <td><button type="button" class="btn btn-primary <?= ($row->status === 'Lunas' || $row->biaya == 0) ? 'disabled' : ''; ?>" data-bs-toggle="modal" data-bs-target="#<?= $row->kd_pemeriksaan ?>" value="">Bayar</button></td>
                            </tr>
                    <?php
                            $i++;
                        endforeach;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal -->
<?php foreach ($dataPembayaran as $row) : ?>
    <div class="modal fade" id="<?= $row->kd_pemeriksaan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tagihan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/pasien/savePembayaran" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="kd_pemeriksaan" class="col-form-label">Kode Pemeriksaan</label>
                            <input type="text" class="form-control" value="<?= $row->kd_pemeriksaan ?>" name="kd_pemeriksaan" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_transaksi" class="col-form-label">No Transaksi</label>
                            <input type="text" class="form-control" value="<?= $row->no_transaksi ?>" name="no_transaksi" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="biaya" class="col-form-label">Total Biaya</label>
                            <input type="text" class="form-control" value="<?= $row->biaya ?>" name="biaya" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="file">Bukti Transfer</label>
                            <input type="file" class="form-control" name="file">
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