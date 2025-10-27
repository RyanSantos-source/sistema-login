<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";
// INICIA A SESSÃO

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

    $msg = '';

    if ($_POST["id_fornecedor"] == "") {
        $postfields = array(
            "razao_social" => $_POST["razao_social"],
            "cnpj" => $_POST["cnpj"],
            "telefone" => $_POST["telefone"],
            "email" => $_POST["email"],
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
        require("../requests/fornecedor/post.php");
    } else {
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        $postfields = array(
            "id_fornecedor" => $_POST["id_fornecedor"],
            "razao_social" => $_POST["razao_social"],
            "cnpj" => $_POST["cnpj"],
            "telefone" => $_POST["telefone"],
            "email" => $_POST["email"],
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
        require("../requests/fornecedor/put.php");
    }
    $_SESSION["msg"] = $response['message'];
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location: ./");
}