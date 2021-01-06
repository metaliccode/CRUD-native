<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";
//jika tombol di tekan
$id = $_GET["id"];
// var_dump($id);
// query data mahasiswa
$mhs = query("SELECT * FROM mahasiswa WHERE id=$id")[0];
// var_dump($mhs[0]["nama"]);  -> hasilnya array numeric karena punya  $rows []0
// var_dump($mhs["nama"]);

if (isset($_POST["submit"])) {

    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Data GAGAL diubah');
            document.location.href = 'index.php';
        </script>
    ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Tambah Mahasiswa</title>
</head>

<body>
    <h1>Ubah Data Mahasiswa </h1>
    <ul>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
            <input type="hidden" name="gambarlama" value="<?= $mhs["gambar"]; ?>">
            <li>
                <label for="nip">NIP.</label>
                <input type="text" name="nip" id="nip" value="<?= $mhs["nip"]; ?>" required>
            </li>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?= $mhs["nama"]; ?>" required>
            </li>
            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?= $mhs["email"]; ?>" required>
            </li>
            <li>
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"]; ?>" required>
            </li>
            <li>
                <label for="gambar">Gambar</label>
                <br>
                <img src="img/<?= $mhs["gambar"]; ?>" width="60" height="60">
                <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <br>
                <button name="submit">Ubah Data!</button>
            </li>
        </form>

    </ul>
</body>

</html>