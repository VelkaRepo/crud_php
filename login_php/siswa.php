<?php
if (!isset($_GET['aksi'])){
?>
    <a type="button" href="index.php?page=siswa&aksi=tambah">Tambah Siswa</a>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $siswa=mysqli_query($koneksi, "SELECT * FROM siswa");
        $no = 1;
        while ($data = mysqli_fetch_array($siswa)){
        ?>
            <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['nis']; ?></td>
            <td><?php echo $data['nama_siswa']; ?></td>
            <td><?php echo $data['jenis_kelamin']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><a href="index.php?page=siswa&aksi=edit&id=<?php echo $data['id_siswa'] ?>">Edit</a> |
                 <a href="index.php?page=siswa&aksi=hapus&id=<?php echo $data['id_siswa'] ?>">Hapus</a></td>
            </tr>
        <?php
        $no++;
        }
        ?>
        </tbody>
    </table>
    <?php
}elseif ($_GET['aksi']=='tambah'){
?>
    <form action='' method="POST" enctype='multipart/form-data'>
    
    <label>NIS</label>
    <input type="text" name="a"><br>
    
    <label>Nama Siswa</label>
    <input type="text" name="b"><br>
    
    <label>Jenis Kelamin</label>
    <input type="text" name="c"><br>
    
    <label>Alamat</label>
    <input type="text" name="d"><br>
    
    <label>Foto Siswa</label>
    <input type="file" name="e"><br>
    
    <button type="submit" name="simpan">Simpan</button>
<?php
if (isset($_POST['simpan'])){
    $dir_foto = 'foto/';
    $filename = basename($_FILES['e']['name']);
    $uploadfile = $dir_foto . $filename;
        if ($filename != ''){
            if (move_uploaded_file($_FILES['e']['tmp_name'], $uploadfile)) {
                mysqli_query($koneksi,"INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, alamat, foto_siswa)
                                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$filename')");
            
            echo "<script>window.alert('Sukses Menambahkan Data Siswa.');
                    window.location='siswa'</script>";
            }else{
                echo "<script>window.alert('Gagal Menambahkan Data Siswa.');
                        window.location='index.php?page=siswa&aksi=tambah'</script>";
            }
        }else{
                mysqli_query($koneksi,"INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, alamat)
                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]')");
                
                echo "<script>window.alert('Sukses Menambahkan Data Siswa .');
                        window.location='siswa'</script>";
        }
}
}elseif ($_GET['aksi']=='edit'){
    $siswa = mysqli_query($koneksi, "SELECT * FROM siswa where id_siswa='$_GET[id]'");
    $data = mysqli_fetch_array($siswa);
?>
    <form action='' method="POST" enctype='multipart/form-data'>
    
    <label>NIS</label>
    <input type="text" name="a" value="<?php echo $data['nis']; ?>"><br>
    
    <label>Nama Siswa</label>
    <input type="text" name="b" value="<?php echo $data['nama_siswa']; ?>"><br>
    
    <label>Jenis Kelamin</label>
    <input type="text" name="c" value="<?php echo $data['jenis_kelamin']; ?>"><br>
    
    <label>Alamat</label>
    <input type="text" name="d" value="<?php echo $data['alamat']; ?>"><br>
    
    <label>Foto Siswa</label>
    <input type="file" name="e"><br>
    
    <button type="submit" name="update">Simpan</button>
<?php
if (isset($_POST['update'])){
    $dir_foto = 'foto/';
    $filename = basename($_FILES['e']['name']);
    $uploadfile = $dir_foto . $filename;
        if ($filename != ''){
            if (move_uploaded_file($_FILES['e']['tmp_name'], $uploadfile)) {
            mysqli_query($koneksi,"UPDATE siswa SET nis = '$_POST[a]',
                                                    nama_siswa = '$_POST[b]',
                                                    jenis_kelamin = '$_POST[c]',
                                                    alamat = '$_POST[d]',
                                                    foto_siswa = '$filename' where id_siswa = '$_GET[id]'");
            echo "<script>window.alert('Sukses Update Data Siswa.');
                    window.location='siswa'</script>";
            }else{
            echo "<script>window.alert('Gagal Update Data Siswa.');
                    window.location='index.php?page=siswa&aksi=tambah'</script>";
        }
        }else{
                mysqli_query($koneksi,"UPDATE siswa SET nis = '$_POST[a]',
                                                        nama_siswa = '$_POST[b]',
                                                        jenis_kelamin = '$_POST[c]',
                                                        alamat = '$_POST[d]',
                                                        foto_siswa = '$filename' where id_siswa ='$_GET[id]'");
        echo "<script>window.alert('Sukses Update Data Siswa .');
                window.location='siswa'</script>";
    }
}
}elseif ($_GET['aksi']=='hapus'){
    mysqli_query($koneksi, "DELETE FROM siswa where id_siswa='$_GET[id]'");
    echo "<script>window.alert('Data Siswa Berhasil Di Hapus.');
            window.location='siswa'</script>";
    }
?>
