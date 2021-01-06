<?php
// koneklsi ke database 
$con = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_phpdasar"
);

// function query
function query($query)
{
    global $con;
    // $query = "SELECT * FROM mahasiswa";
    $result = mysqli_query($con, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// functions TAmbah
function tambah($data)
{
    global $con;
    //anti script hacker
    $nip = htmlspecialchars($data["nip"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // $gambar = htmlspecialchars($data["gambar"]);
    // untuk upload file 
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // query insertdata
    $query = "INSERT INTO mahasiswa VALUES(
        NULL,  '$nama', '$nip', '$email', '$jurusan', '$gambar'
    )";
    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}


function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
            alert ('Pilih gambar terlebih dahulu ! ');
            </script>
       ";
        return false;
    }

    // cek file yang boleh di upload 
    $ekstensiValid = ['jpeg', 'jpg', 'png'];
    // kegunaan fungsi explode (,) -> untuk merubah gambar menjadi string
    // jika paek delimiter -> ihsan.jpg = ['ihsan', 'jpg']
    $ekstensiGambar = explode('.', $namaFile);
    // untuk mengambil end () ekstensi string terakhir .
    // strtolower () berfungsi untuk merubah semuah string menjadi huruf kecil
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    // in_array () -> untuk cek apkh string ada dalam array
    if (!in_array($ekstensiGambar, $ekstensiValid)) {
        echo "<script>
        alert ('Yang anda upload bukan gambar !');
        </script>
   ";
        return false;
    }

    // cek ukuran jika terlalu besar -> dalam byte
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert ('Ukuran gambar terlalu besar !');
        </script>
            ";
        return false;
    }

    // Jika sudah lolos pengecekan 
    // fungsi untuk memindahkan gambar dari dir sementara
    // generate nama baru -> supaya tidak bentrok dgn nama yang sama 
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    // agar bisa di masukan ke fungsi upload
    return $namaFileBaru;
}

function hapus($id)
{
    global $con;
    mysqli_query($con, "DELETE FROM mahasiswa WHERE id = $id");
    //cek database;
    return mysqli_affected_rows($con);
}

function ubah($data)
{
    global $con;
    //anti script hacker
    $id = htmlspecialchars($data["id"]);

    $nip = htmlspecialchars($data["nip"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarlama = $data["jurusan"];

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 0) {
        $gambar = upload();
    } else {
        $gambar = $gambarlama;
    }

    // query UPDATE data mahasiswa
    $query = "UPDATE mahasiswa SET 
         nama = '$nama', 
         nip = '$nip', 
         email = '$email',
         jurusan = '$jurusan',
         gambar =  '$gambar'
         WHERE id=$id
    ";
    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}

function cari($keyword)
{
    // $query_cari = "SELECT * FROM mahasiswa WHERE nama='$keyword' ";
    $query_cari = "SELECT * FROM mahasiswa WHERE 
    nama LIKE '%$keyword%' OR 
    nip LIKE '%$keyword%' OR 
    email LIKE '%$keyword%' OR 
    jurusan LIKE '%$keyword%'
    ORDER BY id DESC;
    ";

    // memanggil variable query yang pertama 
    return query($query_cari);
}

function registrasi($data)
{
    global $con;
    // stripslashes -> berfungsi untuk mengatasi tidak masuk db kek '/' dll
    $username = strtolower(stripslashes($data["username"]));

    // mysqli_real_escape_string -> agar bisa menuliskan karakter kutif dll
    $password = mysqli_real_escape_string($con, $data["password"]);
    $password2 = mysqli_real_escape_string($con, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($con, "SELECT username FROM users WHERE username = '$username' ");
    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('Username sudah terdaftar !');
            </script>
        ";
        // untuk menghentikan insert dijalankan
        return false;
    }

    // cek konfirmasi password
    if ($password != $password2) {
        echo "
            <script>
                alert('Konfirmasi password tidak sesuai');
            </script>
        ";
        // ->untuk return ke mysqli_error
        return false;
    }

    // enkripsi password jangan pake md5 lagi kerena sudah mudah di bobol
    // PASSWORD_DEFAULT akan trs berubah jika ada uodate pengamanan baru dari php
    $password = password_hash($password, PASSWORD_DEFAULT);
    // var_dump($password);
    // die;

    // tambahkan user baru ke database
    mysqli_query(
        $con,
        "INSERT INTO users VALUES
            (NULL, '$username', '$password')"
    );

    return mysqli_affected_rows($con);

    // return 1; -> cek berhasil data dimasukan
}
