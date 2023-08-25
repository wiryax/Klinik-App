<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-primary p-2">
            <div class="container-fluid d-flex justify-content-end">
                <span class="me-1">
                    <a href="#offcanvas" class="border border-0 text-light" data-bs-toggle="offcanvas">###</a>
                </span>
                <button type="button" class="btn btn-primary position-relative">
                    <i class="bi bi-bell-fill"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        1
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button>
            </div>
        </nav>

        <nav class="sidebar position-fixed top-0 left-0 bg-primary text-white">
            <header>
                <div class="image-text d-flex align-items-center">
                    <span class="image d-flex align-items-center">
                        <i class="bi bi-person-circle"></i>
                    </span>
                    <div class="text d-flex flex-column">
                        <span class="text h-6">Selamat Datang</span>
                        <span class="h3 fw-bold"><?= session()->get('pasien') ?></span>
                    </div>
                </div>
                <i class="bi bi-chevron-right toggle bg-success text-light fw-bolder"></i>
            </header>
            <hr>
            <div class="menu-bar d-flex flex-column justify-content-between">
                <div class="menu">
                    <ul class="menu-links">
                        <li class="nav-link d-flex align-items-center list-group-item-action">
                            <a href="/pasien/" class="text-decoration-none d-flex align-items-center text-white p-1">
                                <i class="bi bi-person-lines-fill icon d-flex align-items-center"></i>
                                <span class="text nav-text">Ambil Nomer Antrian</span>
                            </a>
                        </li>
                        <li class="nav-link d-flex align-items-center list-group-item-action">
                            <a href="/pasien/Resep" class="text-decoration-none d-flex align-items-center text-white p-1">
                                <i class="bi bi-input-cursor icon d-flex align-items-center "></i>
                                <span class="text nav-text">Hasil Pemeriksaan</span>
                            </a>
                        </li>
                        <li class="nav-link d-flex align-items-center list-group-item-action">
                            <a href="/pasien/Pembayaran" class="text-decoration-none d-flex align-items-center text-white p-1">
                                <i class="bi bi-person-check icon d-flex align-items-center"></i>
                                <span class="text nav-text">Pembayaran</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="menu-bottom">
                    <ul class="menu-links">
                        <li class="nav-link nav-link d-flex align-items-center list-group-item-action">
                            <a href="/pasien/masukan" class="text-decoration-none d-flex align-items-center text-white p-1">
                                <i class="bi bi-envelope-exclamation icon d-flex align-items-center"></i>
                                <span class="text nav-text">Saran & Kritik</span>
                            </a>
                        </li>
                        <li class="nav-link nav-link d-flex align-items-center list-group-item-action">
                            <a href="/Home/Logout" class="text-decoration-none d-flex align-items-center text-white p-1">
                                <i class="bi bi-box-arrow-in-left icon d-flex align-items-center"></i>
                                <span class="text nav-text">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content pt-1">
            <?php $this->renderSection('content'); ?>
        </div>
    </div>
    <!-- Off Canvas -->

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">###</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul>
                <li><a href="<?= base_url('language/id') ?>">Indonesia</a></li>
                <li><a href="<?= base_url('language/en') ?>">English</a></li>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>