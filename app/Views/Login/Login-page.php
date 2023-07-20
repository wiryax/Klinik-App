<?php $this->extend('/template-log/template') ?>
<?php $this->section('Login-page') ?>

<div class="container-xxl position-absolute top-50 start-50 translate-middle">
    <div class="row align-items-center">
        <div class="col">
            <div class="mb-5">
                <h3><strong>Selamat Datang Di Web Site Klinik Dokter Wulan</strong></h3>
            </div>
            <div class="mb-3 text-secondary">
                <h5>Silahkan Login Untuk Menggunakan Sitem Klinik</h5>
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
            <form action="/Home/Login" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username...">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password...">
                </div>
                <div class="mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check-inline form-check">
                                <input type="checkbox" name="R-me" class="form-check-input">
                                <label for="R-me" class="form-check-label">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-4 text-end">
                            <div class="form-check-inline form-check">
                                <a href="/Home/Registrasi">Regristrasi Akun Baru</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-primary">Log In</button>
                </div>
            </form>
        </div>

        <div class="col background">
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