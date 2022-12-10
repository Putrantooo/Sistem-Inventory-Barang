<?php
@session_start();
include 'security.php';
include "inc/koneksi.php";
session_destroy();
header('Location: login.php');
