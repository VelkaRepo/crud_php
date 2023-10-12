<!DOCTYPE hmtl>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat Form Login</title>
</head>

<body>
    <h1>Login</h1>
    <form action="" method="POST">
        <label>Username</label><br>
        <input type="text" name="username"><br>
        <label>Password</label><br>
        <input type="password" name="password"><br>
        <button type="submit" name="login">Log in</button>
    </form>
<?php
include "koneksi.php";
if (isset($_POST['login'])){
$user = $_POST['username'];
$pass = md5($_POST['password']);
$login=mysqli_query($koneksi, "SELECT * FROM user
WHERE username='$user' AND password='$pass'");
$cocok=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);
if ($cocok > 0){
$_SESSION['username'] = $r['username'];
header('location:index.php');
}else{
echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses');
window.location=('index.php')</script>";
}
}
?>
</body>

</html>