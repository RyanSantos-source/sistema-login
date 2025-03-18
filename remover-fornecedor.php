<?php

// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

if(isset($_GET["key"])) {
    $key = $_GET["key"];
    // UNSET = REMOVE UM ITEM DE UM ARRAY
    unset($_SESSION["fornecedores"][$key]);
    // ARRAY_VALUES = REORGANIZA OS ÍNDICES DO ARRAY
    $_SESSION["fornecedores"] = array_values($_SESSION["fornecedores"]);
    $_SESSION["msg"] = "Fornecedor removido com sucesso!";
}
header("Location: fornecedores.php");
exit;