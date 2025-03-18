<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $client = $_SESSION["clientes"][$key];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    include "mensagens.php";
    include "navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Formulário de cadastro de clientes -->
                <h2>
                    Cadastrar Cliente
                    <a href="clientes.php" class="btn btn-primary btn-sm">Novo Cliente</a>
                </h2>
                <form id="productForm" action="cadastrar-cliente.php" method="POST">
                    <div class="mb-3">
                        <label for="clientId" class="form-label">Código do Cliente</label>
                        <input type="text" class="form-control" id="clientId" name="clientId" readonly value="<?php echo isset($key) ? $key : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="clientName" class="form-label">Nome do Cliente</label>
                        <input type="text" class="form-control" id="clientName" name="clientName" required value="<?php echo isset($client) ? $client["clientName"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="clientCPF" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="clientCPF" name="clientCPF" required value="<?php echo isset($client) ? $client["clientCPF"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="clientEmail" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="clientEmail" name="clientEmail" required value="<?php echo isset($client) ? $client["clientEmail"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="clientWhatsapp" class="form-label">Whatsapp</label>
                        <input type="text" class="form-control" id="clientWhatsapp" name="clientWhatsapp" required value="<?php echo isset($client) ? $client["clientWhatsapp"] : ""; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Tabela de clientes cadastrados -->
                <h2>Clientes Cadastrados</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="clientTableBody">
                        <!-- Os clientes serão carregados aqui via PHP -->
                        <?php
                        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
                        if(!empty($_SESSION["clientes"])) {
                            foreach($_SESSION["clientes"] as $key => $client) {
                                echo '
                                <tr>
                                    <th scope="row">'.($key + 1).'</th>
                                    <td>'.$client["clientName"].'</td>
                                    <td>'.$client["clientCPF"].'</td>
                                    <td>'.$client["clientEmail"].'</td>
                                    <td>'.$client["clientWhatsapp"].'</td>
                                    <td>
                                        <a href="clientes.php?key='.$key.'" class="btn btn-warning">Editar</a>
                                        <a href="remover-cliente.php?key='.$key.'" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="5">Nenhum cliente cadastrado</td>
                            </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>