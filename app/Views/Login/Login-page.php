<?php $this->extend('/template-log/template') ?>
<?php $this->section('Login-page') ?>

<div class="container container-md container-sm position-absolute top-50 start-50 translate-middle pt-5 pb-5">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="mb-5">
                <h6 class="display-6 fw-semibold"><?= lang($lang . "Welcome-Header") ?></h6>
            </div>
            <div class="mb-3 text-secondary display-6">
                <h6 class="fs-5"><?= lang($lang . "Login-Header") ?></h6>
            </div>
            <?php if (session()->getFlashdata('massage')) : ?>
                <div class="mb-5">
                    <div class="<?= session()->getFlashdata('classMassage') ?>" role="alert">
                        <?= session()->getFlashdata('massage') ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('invalidSignUp')) : ?>
                <div class="mb-5">
                    <div class="<?= session()->getFlashdata('classInvalid') ?>" role="alert">
                        <?= session()->getFlashdata('invalidSignUp') ?>
                    </div>
                </div>
            <?php endif; ?>
            <form action="<?= base_url() ?>Home/Login" method="post">
                <div class="mb-3 input-group input-group-sm input-group-md">
                    <input type="text" class="form-control" name="username" placeholder="Username...">
                </div>
                <div class="mb-3 input-group input-group-sm input-group-md">
                    <input type="password" class="form-control" name="password" placeholder="Password...">
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col col-md-6 col-sm-6">
                            <div class="form-check-inline form-check input-group-sm input-group-md">
                                <input type="checkbox" name="R-me" class="form-check-input">
                                <label for="R-me" class="form-check-label">
                                    <h6 class="fw-normal"><?= lang($lang . "Cookie-Set") ?></h6>
                                </label>
                            </div>
                        </div>
                        <div class="col col-md-6 col-sm-6 text-end">
                            <div class="form-check-inline form-check">
                                <a href="<?= base_url() ?>Home/Registrasi"><?= lang($lang . "Sign-Up") ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 col-4 col-sm-4 col-md-4 mx-auto text-center">
                    <button type="submit" class="btn btn-primary btn-md"><?= lang($lang . "Log-in") ?></button>
                </div>
            </form>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 background">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/img/Login-bg.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/img/Login-bg.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/img/Login-bg.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-primary" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-primary" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>