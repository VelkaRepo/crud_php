<?php
session_start();
include "koneksi.php";
if (isset($_SESSION['username'])==''){
include "login.php";
}else{
include "konten.php";
}
?>