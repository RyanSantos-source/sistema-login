<?php
session_start();
session_destroy();
unset($_SESSION["autenticado"]);
header("Location: ./tela-login.php");
exit;