<?php
session_start();
$_COOKIE["login"] = false;
$_SESSION = [];
// agar memastikan season hilang 
session_unset();
// hapus cookie
setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

session_destroy();

header("Location: login.php");
exit;
