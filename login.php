<?php
require 'functions.php';

session_start();
// cek cookie dulu
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    //ambil username berdasarkan id
    $result = mysqli_query($con, "SELECT username FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if ($key === hash('gost-crypto', $row["username"])) {
        $_SESSION["login"] = true;
    }

    // if ($_COOKIE["login"] == "true") {
    //     $_SESSION["login"] = true;
    // }


}



if (isset($_SESSION["login"])) {
    header("Location: index.php");
}


if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' ");

    // cek username
    // mysqli_num_rows -> untuk menngecek berapa baris yang ada $result username 1/0
    if (mysqli_num_rows($result) === 1) {

        //cek pasword 
        $row = mysqli_fetch_assoc($result);
        // unutk cek pass hasil hsh atau dekripsi dari hash untuk verifikasi user yang sudah terdaftar
        if (password_verify($password, $row["password"])) {
            // set session 
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST["remember"])) {
                // buat cookie -> 1800 detik = 30 menit
                setcookie('id',  $row["id"], time() + 1800);
                setcookie('key', hash('gost-crypto', $row["username"]), time() + 1800);
            }

            header("Location: index.php");
            // exit -> untuk memberhentikan samapai header saja tanpa eksekusi script di bawah
            exit;
        }
    }
    //jika username dan pass gak ada langsung loncat ke error
    // variable untuk memeberi tahu error 
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>

<body>
    <h1>Halaman Login</h1>
    <?php if (isset($error)) : ?>
        <p style="color:red; font-style:italic;">Username / password salah !</p>
    <?php endif; ?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </li>

            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>

</html>