<?php

// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

if(isset($_GET["key"])) {
    $key = $_GET["key"];
    // UNSET = REMOVE UM ITEM DE UM ARRAY
    unset($_SESSION["clientes"][$key]);
    // ARRAY_VALUES = REORGANIZA OS ÍNDICES DO ARRAY
    $_SESSION["clientes"] = array_values($_SESSION["clientes"]);
    $_SESSION["msg"] = "Cliente removido com sucesso!";
}
header("Location: clientes.php");
exit;