<?php
include('inc/koneksi.php');

if (!(@$_SESSION['username'])) {
    echo "<script>window.location='" . ('login.php') . "';</script>";
}
