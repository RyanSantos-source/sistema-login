<?php

// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

if(isset($_GET["key"])) {
    $key = $_GET["key"];
    // UNSET = REMOVE UM ITEM DE UM ARRAY
    unset($_SESSION["vendas"][$key]);
    // ARRAY_VALUES = REORGANIZA OS ÍNDICES DO ARRAY
    $_SESSION["vendas"] = array_values($_SESSION["vendas"]);
    $_SESSION["msg"] = "Venda removida com sucesso!";
}
header("Location: vendas.php");
exit;