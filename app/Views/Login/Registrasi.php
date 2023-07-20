<?php $this->extend('template-log/template'); ?>
<?php $this->section('Regist-Page') ?>

<div class="container position-absolute top-50 start-50 translate-middle" style="width: 50vw;">
    <div class="row align-items-center">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">
                    <h1 class="">Silahkan Input Data Diri Anda</h1>
                    <?php if (session()->getFlashdata('regist')) : ?>
                        <div class="mb-5">
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashdata('regist') ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <form action="/Home/insertDataPasien" method="post">
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control <?= (session('nama')) ? 'is-invalid' : '' ?>" name="nama" autofocus required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" required>
                            <div class="form-text">Masukan Alamat Sesuai KTP</div>
                        </div>
                        <div class="mb-4">
                            <label for="no_tlp" class="form-label">Nomer Telphone</label>
                            <input type="text" class="form-control" name="no_tlp" required>
                            <div class="form-text">Masukan Nomer Telphone Yang Valid</div>
                        </div>

                        <div class="mb-4 d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-primary" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>