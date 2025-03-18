<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// VERIFICAR SE ESTÁ VINDO DADOS DO PRODUTO
if($_POST) {
    // VERIFICAR ITENS DO POST
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    // exit;

    // VAZIO SIGNIFICA PRODUTO NOVO
    if ($_POST["saleId"] == "") {
        $_SESSION["vendas"][] = $_POST; // OU
    } else {
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        $_SESSION["vendas"][$_POST["saleId"]] = $_POST;
    }

    // AMBAS AS LINHAS FAZEM A MESMA COISA
    // array_push($_SESSION["produtos"], $_POST);
    $_SESSION["msg"] = "Venda cadastrada com sucesso!";    
}

header("Location: ./vendas.php");