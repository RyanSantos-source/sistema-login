<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "produto";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/produto/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $produto = $response["data"][0];
    } else {
        $produto = null;
    }
}

$key = null; // limpando a variável $key para trazer todos os produtos
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de produto</title>
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
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-rigth">
                        <h2>
                            Produtos Cadastrados
                        </h2>
                        <div>
                            <a href="exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                            <a href="exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                            <a href="formulario.php" class="btn btn-primary btn-sm"> Cadastrar Cliente</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tabela" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="clientTableBody">
                                <!-- Os produtos serão carregados aqui via PHP -->
                                <?php
                        // SE HOUVER produtos NA SESSÃO, EXIBIR

                        require("../requests/produto/get.php");
                        if (!empty($response["data"])) {
                            foreach ($response["data"] as $produto) {
                                // Mapear o ID da marca para o nome
                                echo '
                                <tr>
                                    <th scope="row">' . $produto["id_produto"] . '</th>
                                    <td>' . $produto["produto"] . '</td>    
                                    <td>'.$produto["marca"].'</td>
                                    <td>' . $produto["quantidade"] . '</td>
                                    <td>R$ ' . number_format($produto["preco"], 2, ',', '.') . '</td>
                                    <td>
                                        <a href="/produto/formulario.php?key=' . $produto["id_produto"] . '" class="btn btn-warning">Editar</a>
                                        <a href="/produto/remover.php?key=' . $produto["id_produto"] . '" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="6">Nenhum produto cadastrado</td>
                            </tr>
                            ';
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Tabela de produto cadastrados -->




            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
    let table = new DataTable('#tabela', {
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
        }
    });
    </script>


    <script>
    $(document).ready(function() {
        // Máscara para o preço
        $('#preco').mask('#.##0,00', {
            reverse: true
        });
    });
    </script>
</body>

</html>