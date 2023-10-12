<?php
if (!isset($_GET['page'])){
    echo "Selamat, anda berhasil login $_SESSION[username]!";
    echo "<br>";
    echo "<a href=logout.php>Logout</a>";
}elseif ($_GET['page']=='siswa'){
    include "siswa.php";
}else{
    echo "Maaf, halaman tidak ditemukan!";
}
?>