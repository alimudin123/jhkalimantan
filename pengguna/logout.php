<?php
session_start();
session_destroy();
header("Location: user_akun.php");
exit();
?>