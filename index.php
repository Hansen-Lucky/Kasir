<?php
session_start();

if (!isset($_SESSION['dataBarang'])) {
    $_SESSION['dataBarang'] = [];
}

if (empty($_SESSION['dataBarang'])) {
    $_SESSION['noTransaksi'] = random_int(12345678, 98765432);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaBarang = htmlspecialchars($_POST['namaBarang']);
    $harga = (int)htmlspecialchars($_POST['harga']);
    $jumlah = (int)htmlspecialchars($_POST['jumlah']);
    $total = $harga * $jumlah;

    $foundKey = null;

    foreach ($_SESSION['dataBarang'] as $key => $value) {
        if ($value['namaBarang'] === $namaBarang) {
            $foundKey = $key;
            break;
        }
    }

    if ($foundKey !== null) {
        $_SESSION['dataBarang'][$foundKey]['jumlah'] += $jumlah;
        $_SESSION['dataBarang'][$foundKey]['total'] = $_SESSION['dataBarang'][$foundKey]['harga'] * $_SESSION['dataBarang'][$foundKey]['jumlah'];
        $_SESSION['info'] = "Nama barang <b>{$namaBarang}</b> berhasil diupdate. <br>Note: Harga barang tidak dapat diubah";
    } else {
        $_SESSION['dataBarang'][] = [
            'namaBarang' => $namaBarang,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'total' => $total
        ];
        $_SESSION['info'] = 'Berhasil ditambahkan';
    }

    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

$_SESSION['totalKeseluruhan'] = array_sum(array_column($_SESSION['dataBarang'], 'total'));
?>

<!doctype html>
<html lang="en">

<head>
    <title>Data Barang</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        margin-top: 20px;
    }

    .form-group input {
        margin-bottom: 10px;
    }

    .btn-primary svg,
    .btn-success svg,
    .btn-danger svg {
        margin-right: 5px;
    }
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($_SESSION['info'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['info'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['info']); ?>
        <?php endif; ?>

        <div class="card">
            <div class="card-header text-center">
                <h2>Masukan Data Barang</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <input type="text" id="namaBarang" name="namaBarang" class="form-control"
                            placeholder="Nama barang" required>
                    </div>
                    <div class="form-group">
                        <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga" required>
                    </div>
                    <div class="form-group">
                        <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah"
                            required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path
                                    d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                <path
                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg> Tambah
                        </button>
                        <?php if (!empty($_SESSION['dataBarang'])) : ?>
                        <a href="cekout.php" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 
                                                                0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                            </svg> Bayar
                        </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <hr>

        <div class="card mt-4">
            <div class="card-header text-center">
                <h2>List Barang</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($_SESSION['dataBarang'])) : ?>
                            <?php $index = 0; ?>
                            <?php foreach ($_SESSION['dataBarang'] as $key => $value) : ?>
                            <tr>
                                <?php $index++; ?>
                                <th scope="row"><?= $index ?></th>
                                <td><?= $value['namaBarang'] ?></td>
                                <td><?= "Rp " . number_format($value['harga'], 0, ',', '.') ?></td>
                                <td><?= $value['jumlah'] ?></td>
                                <td><?= "Rp " . number_format($value['total'], 0, ',', '.') ?></td>
                                <td>
                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        href="delete.php?index=<?= $key ?>" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-cart-dash" viewBox="0 0 16 16">
                                            <path d="M6.5 7a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                                            <path
                                                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                        </svg> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="table-light">
                                <td colspan="5">Total Barang</td>
                                <td><?= $index ?></td>
                            </tr>
                            <tr class="table-light">
                                <td colspan="5">Total Harga</td>
                                <td><?= "Rp " . number_format($_SESSION['totalKeseluruhan'], 0, ',', '.') ?></td>
                            </tr>
                            <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center text-danger py-3">Tidak ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>