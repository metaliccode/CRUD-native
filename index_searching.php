<!-- cara lama  -->
<?php
// koneklsi ke database 
require 'functions.php';

// ambil data dari data table mahasiswa/ query datamahsiswa
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

// tombol cari di klik 
if (isset($_POST["cari"])) {
    $mahasiswa =  cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>

<body>
    <h1>Daftar Mahasiswa</h1>
    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>
    <form action="" method="POST">
        <input type="text" name="keyword" size="30" autofocus placeholder="Masukan Keyword Pencarian..." autocomplete="off">
        <button type="submit" name="cari">CARI!</button>
    </form>
    <br>

    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Nip</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1;
        foreach ($mahasiswa as $row) :
        ?>
            <tr>
                <td><?= $i; ?></td>
                <td><img src="img/<?= $row["gambar"]; ?>" width="30"></td>
                <td><?= $row["nip"]; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["jurusan"]; ?></td>

                <td>
                    <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a>
                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');">Hapus</a>
                </td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>



</body>

</html>