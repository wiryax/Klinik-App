<?php $this->extend('pasien/template') ?>
<?php $this->section('content') ?>

<div class="container position-absolute top-50 start-50 translate-middle" style="width: 40%;">
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('masukan')) :  ?>
                <div class="mb-3">
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('masukan') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="mb-5">
                <h2 class="text-center">Saran Dan Masukan</h2>
            </div>
            <form action="/pasien/kirimMasukan" method="post">
                <div class="input-group mb-5">
                    <span class="input-group-text" id="basic-addon3">username</span>
                    <input type="text" class="form-control" name="username" aria-describedby="basic-addon3 basic-addon4" value="<?= session()->get('pasien') ?>" readonly>
                </div>
                <div class="input-group mb-5">
                    <span class="input-group-text" id="basic-addon3">Perihal</span>
                    <input type="text" class="form-control" name="perihal" aria-describedby="basic-addon3 basic-addon4">
                    <!-- <div class="form-text" id="basic-addon4">Example help text goes outside the input group.</div> -->
                </div>
                <div class="input-group mb-5">
                    <span class="input-group-text">Pesan</span>
                    <textarea class="form-control" aria-label="With textarea" name="masukan"></textarea>
                </div>
                <div class=" text-center">
                    <button type="submit" class="btn btn-primary">Kirim Masukan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection() ?>