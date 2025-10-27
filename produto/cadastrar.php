<?php
include "../verificar-autenticacao.php";

try {

        if (!$_POST) {
        throw new Exception("Acesso indevído! Tente novamente.");
    }

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

        // SE JÁ EXISTIR UMA IMAGEM, DELETAR A IMAGEM
        if ($_POST["currentproductImage"] != "") {
            // UNLINK = DELETAR ARQUIVOS
            unlink("imagens/" . $_POST["currentproductImage"]);
        }
    } else {
        // SE NÃO FOI ENVIADO ARQUIVO, PEGAR O NOME DO ARQUIVO ATUAL
        $_POST["productImage"] = $_POST["currentproductImage"];
    }

    $msg = '';

    if ($_POST["id_produto"] == "") {
        $postfields = array(
            "produto" => $_POST["produto"],
            "descricao" => $_POST["descricao"],
            "id_marca" => $_POST["id_marca"],
            "quantidade" => $_POST["quantidade"],
            "preco" => $_POST["preco"]
        );
        require("../requests/produto/post.php");
    } else {
        $postfields = array(
            "id_produto" => $_POST["id_produto"],
            "produto" => $_POST["produto"],
            "descricao" => $_POST["descricao"],
            "id_marca" => $_POST["id_marca"],
            "quantidade" => $_POST["quantidade"],
            "preco" => $_POST["preco"]
        );
        require("../requests/produto/put.php");
    }
    $_SESSION["msg"] = $response['message'];
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location: ./");
}