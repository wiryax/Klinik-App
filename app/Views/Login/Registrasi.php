<?php $this->extend('template-log/template'); ?>
<?php $this->section('Regist-Page') ?>

<div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row align-items-center">
        <div class="col-lg-8 col-sm-12 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="display-6"><?= lang($lang . "Regis-Tittle") ?></h4>
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
                        <div class="mb-4 form-floating">
                            <input type="text" class="form-control <?= (session('nama')) ? 'is-invalid' : '' ?>" name="nama" placeholder="<?= lang($lang . "Name") ?>" autofocus required>
                            <label for="nama"><?= lang($lang . "Name") ?></label>
                        </div>
                        <div class="mb-4 form-floating">
                            <input type="password" class="form-control" name="password" placeholder="<?= lang($lang . "Password") ?>" required>
                            <label for="password"><?= lang($lang . "Password") ?></label>
                        </div>
                        <div class="mb-4 form-floating">
                            <input type="text" class="form-control" name="alamat" placeholder="<?= lang($lang . "Address") ?>" required>
                            <label for="alamat"><?= lang($lang . "Address") ?></label>
                            <div class="form-text"><?= lang($lang . "Address-Plchldr") ?></div>
                        </div>
                        <div class="mb-4 form-floating">
                            <input type="text" class="form-control" name="no_tlp" placeholder="<?= lang($lang . "Phone-Num") ?>" required>
                            <label for="no_tlp"><?= lang($lang . "Phone-Num") ?></label>
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