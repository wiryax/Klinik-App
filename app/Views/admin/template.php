<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="sidebar position-fixed top-0 left-0 bg-primary text-white">
        <header>
            <div class="image-text d-flex align-items-center">
                <span class="image d-flex align-items-center">
                    <i class="bi bi-person-circle"></i>
                </span>
                <div class="text d-flex flex-column">
                    <span class="text">Selamat Datang</span>
                    <span><?= session()->get('admin') ?></span>
                </div>
            </div>
        </header>
        <div class="menu-bar d-flex flex-column justify-content-between">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link d-flex align-items-center">
                        <a href="/admin/" class="text-decoration-none d-flex align-items-center text-white">
                            <i class="bi bi-person-lines-fill icon d-flex align-items-center"></i>
                            <span class="text nav-text">List Data Pasien</span>
                        </a>
                    </li>
                    <li class="nav-link d-flex align-items-center">
                        <a href="/admin/daftarPembayaran" class="text-decoration-none d-flex align-items-center text-white">
                            <i class="bi bi-person-check icon d-flex align-items-center"></i>
                            <span class="text nav-text">Verifikasi Pembayaran</span>
                        </a>
                    </li>
                    <li class="nav-link d-flex align-items-center">
                        <a href="/admin/Laporan" class="text-decoration-none d-flex align-items-center text-white">
                            <i class="bi bi-printer-fill icon d-flex align-items-center"></i>
                            <span class="text nav-text">Cetak Laporan</span>
                        </a>
                    </li>
                    <li class="nav-link d-flex align-items-center">
                        <a href="/admin/Masukan" class="text-decoration-none d-flex align-items-center text-white">
                            <i class="bi bi-send-exclamation-fill icon d-flex align-items-center"></i>
                            <span class="text nav-text">Masukan</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu-bottom">
                <ul class="menu-links">
                    <li class="nav-link nav-link d-flex align-items-center list-group-item-action ">
                        <a href="/Home/Logout" class="text-decoration-none d-flex align-items-center text-white">
                            <i class="bi bi-box-arrow-in-left icon d-flex align-items-center"></i>
                            <span class="text nav-text">Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Content Area -->
    <div style="margin-left: 250px;">
        <?php $this->renderSection('content'); ?>
    </div>
    <!-- end Content -->
    <!--  -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>