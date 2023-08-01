<?php $this->extend('template-log/template'); ?>
<?php $this->section('Regist-Page') ?>

<div class="container position-absolute top-50 start-50 translate-middle" style="width: 50vw;">
    <div class="row align-items-center">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">
                    <h1 class=""><?= lang($lang . "Regis-Tittle") ?></h1>
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
                            <label for="nama" class="form-label"><?= lang($lang . "Name") ?></label>
                            <input type="text" class="form-control <?= (session('nama')) ? 'is-invalid' : '' ?>" name="nama" autofocus required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label"><?= lang($lang . "Password") ?></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-4">
                            <label for="alamat" class="form-label"><?= lang($lang . "Address") ?></label>
                            <input type="text" class="form-control" name="alamat" required>
                            <div class="form-text"><?= lang($lang . "Address-Plchldr") ?></div>
                        </div>
                        <div class="mb-4">
                            <label for="no_tlp" class="form-label"><?= lang($lang . "Phone-Num") ?></label>
                            <input type="text" class="form-control" name="no_tlp" required>
                            <div class="form-text"><?= lang($lang . "Phone-Plchldr") ?></div>
                        </div>

                        <div class="mb-4 d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-primary" type="submit"><?= lang($lang . "Regis") ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="<?= base_url('') ?>" class="text-center">Back To Login Page</a>
        </div>
    </div>
</div>

<?php $this->endSection() ?>