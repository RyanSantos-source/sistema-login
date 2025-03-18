<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// VERIFICAR SE ESTÁ VINDO DADOS DO PRODUTO
if($_POST) {
    // VERIFICAR ITENS DO POST
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit;
    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";
    // exit;

    // VERIFICAR SE O ARQUIVO FOI ENVIADO
    if ($_FILES["productImage"]["name"] != "") {
        // PEGAR A EXTENSÃO DO ARQUIVO
        $extensao = pathinfo($_FILES["productImage"]["name"], PATHINFO_EXTENSION);
        // GERAR UM NOVO NOME PARA O ARQUIVO
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // MOVER O ARQUIVO PARA A PASTA DE IMAGENS
        move_uploaded_file($_FILES["productImage"]["tmp_name"], "imagens/$novo_nome");
        // ADICIONAR O NOME DO ARQUIVO NO POST
        $_POST["productImage"] = $novo_nome;
    }

    // VAZIO SIGNIFICA PRODUTO NOVO
    if ($_POST["productId"] == "") {
        $_SESSION["produtos"][] = $_POST; // OU
    } else {
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        $_SESSION["produtos"][$_POST["productId"]] = $_POST;
    }

    // AMBAS AS LINHAS FAZEM A MESMA COISA
    // array_push($_SESSION["produtos"], $_POST);
    $_SESSION["msg"] = "Produto cadastrado com sucesso!";    
}

header("Location: ./produtos.php");