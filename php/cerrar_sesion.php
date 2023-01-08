<?php
session_start();
unset($_SESSION['datos_login']);
session_destroy();
header("Location: ../index.php");

?>