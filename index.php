<?php
// koneksi ke database 
require 'functions.php';
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// pagination dengan query limit -> kofigurasi data perhalaman
$jmldata = 3;
// -> cara lama :
// $result = mysqli_query($con, "SELECT * FROM mahasiswa"); --> object
// $totaldata = mysqli_num_rows($result);
// var_dump($totaldata);

// menggunanakan cara lain array assosiative
$totaldata = count(query("SELECT * FROM mahasiswa"));
// var_dump($totaldata);

// funsi round adalah membulatkan bilangan desimal ke yg terdekat
// floor  -> membulatkan ke bawah 
// ceil -> bulatkan ke atas
$jmlHalaman = ceil($totaldata / $jmldata);

// menentukan halaman aktif
// cara lama --> if (isset($_GET["page"])) {
//     $halamanAktif = $_GET["page"];
// } else {
//     $halamanAktif = 1;
// }

// menggunakan operator ternari krn if nya dikit
$halamanaktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awaldata = ($jmldata * $halamanaktif) - $jmldata;

// ambil data dari data table mahasiswa/ query datamahasiswa
// limit [index, jumlah data]
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC LIMIT $awaldata, $jmldata");

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
    <a href="logout.php">Logout</a>
    <h1>Daftar Mahasiswa</h1>
    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>

    <!-- form pencarian  -->
    <form action="" method="POST">
        <input type="text" name="keyword" size="30" autofocus placeholder="Masukan Keyword Pencarian..." autocomplete="off">
        <button type="submit" name="cari">CARI!</button>
    </form>
    <!-- end form pencarian  -->

    <br>

    <!-- navigasi paginations      -->
    <?php if ($halamanaktif > 1) : ?>
        <a href="?page=<?= $halamanaktif - 1; ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jmlHalaman; $i++) : ?>
        <?php if ($i == $halamanaktif) : ?>
            <a href="?page=<?= $i; ?>" style="font-weight: bold; color:red;">
                <?= $i; ?>
            </a>
        <?php else : ?>
            <a href="?page=<?= $i; ?>">
                <?= $i; ?>
            </a>
        <?php endif; ?>
    <?php endfor ?>

    <?php if ($halamanaktif < $jmlHalaman) : ?>
        <a href="?page=<?= $halamanaktif + 1; ?>">&raquo;</a>
    <?php endif; ?>
    <!-- end navigasi paginations  -->

    <br>
    <!-- tabel mahasiswa  -->
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
    <!-- end table mahasiswa  -->

</body>

</html>