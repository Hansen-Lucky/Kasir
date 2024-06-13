<?php

session_start();

if (empty($_SESSION['dataBarang']) || !isset($_SESSION['kembalian']) || $_SESSION['kembalian'] < 0) {
    header('location: index.php');
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Bukti Pembayaran</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <main class="container py-5">
        <div class="card">
            <div class="card-body">
                <p class="my-5 text-center" style="font-size: 30px;">Bukti Pembayaran</p>
                <div class="row">
                    <ul class="list-unstyled">
                        <li class="text-muted mt-1"><span class="text-black">No. Transaksi</span>
                            #<?= $_SESSION['noTransaksi']; ?></li>
                        <li>Bulan, tanggal
                            <span class="text-muted mt-1"><?= date('F j, Y'); ?></span>
                        </li>
                    </ul>
                    <hr>
                </div>
                <?php foreach ($_SESSION['dataBarang'] as $key => $value) : ?>
                    <div class="row">
                        <div class="col-xl-10">
                            <p><?= $value['namaBarang']; ?></p>
                        </div>
                        <div class="col-xl-2">
                            <p class="float-end">Rp <?= number_format($value['harga'], 0, ',', '.'); ?> <b>x
                                    <?= $value['jumlah']; ?></b>
                            </p>
                        </div>
                        <hr>
                    </div>
                <?php endforeach ?>

                <div class="row my-2 fw-bold">
                    <div class="col-xl-10">
                        <span>Uang Yang Dibayarkan</span>
                    </div>
                    <div class="col-xl-2">
                        <span class="float-end">Rp <?= number_format($_SESSION['jumlahUang'], 0, ',', '.'); ?></span>
                    </div>
                </div>

                <div class="row my-2 fw-bold">
                    <div class="col-xl-10">
                        <span>Total</span>
                    </div>
                    <div class="col-xl-2">
                        <span class="float-end">Rp
                            <?= number_format($_SESSION['totalKeseluruhan'], 0, ',', '.'); ?></span>
                    </div>
                </div>

                <div class="row my-2 fw-bold">
                    <div class="col-xl-10">
                        <span>Kembalian</span>
                    </div>
                    <div class="col-xl-2">
                        <span class="float-end">Rp <?= number_format($_SESSION['kembalian'], 0, ',', '.'); ?></span>
                    </div>
                </div>

                <div class="text-center" style="margin-top: 90px;">
                    <span>Terimakasih telah berbelanja di toko <b>Hansen</b></span>
                    <br>
                    <a href="index.php">Kembali</a>
                </div>
            </div>
        </div>
    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
unset($_SESSION['dataBarang']);
unset($_SESSION['jumlahUang']);
unset($_SESSION['kembalian']);
unset($_SESSION['totalKeseluruhan']);
unset($_SESSION['noTransaksi']);
?>