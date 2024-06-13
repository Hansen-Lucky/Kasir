<?php
session_start();

if (!empty($_SESSION['dataBarang'] && isset($_GET['index']))) {
    unset($_SESSION['dataBarang'][$_GET['index']]);
    $_SESSION['info'] = 'Berhasil dihapus';
    header('Location: index.php');
    exit;
} else {
    header('location : index.php');
    exit;
}