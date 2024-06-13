<?php
session_start();

if (!isset($_SESSION['dataBarang']) || empty($_SESSION['dataBarang'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['submit'])) {
    $jumlahUang = $_POST['jumlahUang'];
    if ($jumlahUang < $_SESSION['totalKeseluruhan']) {
        $_SESSION['info'] = "Uang anda kurang Rp" . number_format($_SESSION['totalKeseluruhan'] - $jumlahUang, 0, ',', '.');
    } else {
        $_SESSION['jumlahUang'] = $jumlahUang;
        $_SESSION['kembalian'] = $jumlahUang - $_SESSION['totalKeseluruhan'];
        header("Location: struck.php");
        exit;
    }
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Checkout</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <main class="container py-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center mb-3">Bayar Sekarang</h1>
                <form action="" method="post" class="form-group">
                    <?php if (isset($_SESSION['info'])) : ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['info']; ?>
                    </div>
                    <?php unset($_SESSION['info']);
                    endif; ?>
                    <div class="mb-3">
                        <label for="jumlahUang" class="form-label">Masukkan Nominal Uang</label>
                        <input type="number" id="jumlahUang" name="jumlahUang" class="form-control"
                            placeholder="Jumlah Uang" required>
                    </div>
                    <div class="mb-3">
                        <b>Total yang harus dibayarkan: Rp.
                            <?= number_format($_SESSION['totalKeseluruhan'], 2, ',', '.'); ?></b>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                            </svg> Bayar
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>