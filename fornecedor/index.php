<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "fornecedor";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/fornecedor/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
       $fornecedor = $response["data"][0];
    } else {
       $fornecedor = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de fornecedores</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md">

                <!-- comecço CARD -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-rigth">

                        <h2>
                            fornecedor Cadastrados
                        </h2>
                        <div>
                            <a href="exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                            <a href="exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                            <a href="formulario.php" class="btn btn-primary btn-sm"> Cadastrar Cliente</a>
                        </div>
                    </div>
                    <table id="tabela" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Razão Socil</th>
                                <th scope="col">CNPJ</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="clientTableBody">
                            <!-- Os fornecedor serão carregados aqui via PHP -->
                            <?php
                        // SE HOUVER fornecedor NA SESSÃO, EXIBIR
                        $key = null; //limpando a variável $key para trazer todos os fornecedor
                        require("../requests/fornecedor/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $key =>$fornecedor) {
                                echo '
                                <tr>
                                    <th scope="row">' . ($fornecedor["id_fornecedor"]) . '</th>
                                    <td>' .$fornecedor["razao_social"] . '</td>
                                    <td>' .$fornecedor["cnpj"] . '</td>
                                    <td>' .$fornecedor["telefone"] . '</td>
                                    <td>' .$fornecedor["email"] . '</td>
                                    <td>
                                        <a href="/fornecedor/formulario.php?key=' .$fornecedor["id_fornecedor"] . '" class="btn btn-warning">Editar</a>
                                        <a href="/fornecedor/remover.php?key=' .$fornecedor["id_fornecedor"] . '" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="7">Nenhum fornecedor cadastrado</td>
                            </tr>
                            ';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- FIM card -->
                <!-- Tabela de fornecedor cadastrados -->

            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->

    <!-- dataTables -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
    let table = new DataTable('#tabela', {
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
        }
    });
    </script>


</body>

</html>