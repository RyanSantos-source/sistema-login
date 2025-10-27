<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// VERIFICAR SE ESTÁ VINDO DADOS DO PRODUTO
// if($_POST) {
//     // VERIFICAR ITENS DO POST
//     // echo "<pre>";
//     // print_r($_SESSION);
//     // echo "</pre>";
//     // exit;

//     // VAZIO SIGNIFICA PRODUTO NOVO
//     if ($_POST["clientId"] == "") {
//         $_SESSION["clientes"][] = $_POST; // OU
//     } else {
//         // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
//         $_SESSION["clientes"][$_POST["clientId"]] = $_POST;
//     }

//     // AMBAS AS LINHAS FAZEM A MESMA COISA
//     // array_push($_SESSION["produtos"], $_POST);
//     $_SESSION["msg"] = "Cliente cadastrado com sucesso!";    
// }

try {
    if (!$_POST) {
        throw new Exception("Acesso indevído! Tente novamente.");
    }
    // VERIFICAR SE O ARQUIVO FOI ENVIADO
    if ($_FILES["imagem"]["name"] != "") {
        // PEGAR A EXTENSÃO DO ARQUIVO
        $extensao = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
        // GERAR UM NOVO NOME PARA O ARQUIVO
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // MOVER O ARQUIVO PARA A PASTA DE IMAGENS
        move_uploaded_file($_FILES["imagem"]["tmp_name"], "imagens/$novo_nome");
        // ADICIONAR O NOME DO ARQUIVO NO POST
        $_POST["imagem"] = $novo_nome;

        // SE JÁ EXISTIR UMA IMAGEM, DELETAR A IMAGEM
        if ($_POST["currentClientImage"] != "") {
            // UNLINK = DELETAR ARQUIVOS
            unlink("imagens/" . $_POST["currentClientImage"]);
        }
    } else {
        // SE NÃO FOI ENVIADO ARQUIVO, PEGAR O NOME DO ARQUIVO ATUAL
        $_POST["imagem"] = $_POST["currentClientImage"];
    }

    $msg = '';

    if ($_POST["id_cliente"] == "") {
        $postfields = array(
            "nome" => $_POST["nome"],
            "cpf" => $_POST["cpf"],
            "email" => $_POST["email"],
            "whatsapp" => $_POST["whatsapp"],
            "imagem" => $_POST["imagem"],
            "endereco" => array(
                "cep" => $_POST["cep"],
                "logradouro" => $_POST["logradouro"],
                "numero" => $_POST["numero"],
                "complemento" => $_POST["complemento"],
                "bairro" => $_POST["bairro"],
                "cidade" => $_POST["cidade"],
                "estado" => $_POST["estado"]
            )
        );
        // echo json_encode($postfields);
        // exit;
        require("../requests/clientes/post.php");
    } else {
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        $postfields = array(
            "id_cliente" => $_POST["id_cliente"],
            "nome" => $_POST["nome"],
            "cpf" => $_POST["cpf"],
            "email" => $_POST["email"],
            "whatsapp" => $_POST["whatsapp"],
            "imagem" => $_POST["imagem"],
            "endereco" => array(
                "cep" => $_POST["cep"],
                "logradouro" => $_POST["logradouro"],
                "numero" => $_POST["numero"],
                "complemento" => $_POST["complemento"],
                "bairro" => $_POST["bairro"],
                "cidade" => $_POST["cidade"],
                "estado" => $_POST["estado"]
            )
        );
        // echo json_encode($postfields);
        // exit;
        require("../requests/clientes/put.php");
    }
    $_SESSION["msg"] = $response['message'];
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location: ./");
}