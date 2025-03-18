<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "fornecedores";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $provider = $_SESSION["fornecedores"][$key];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Fornecedores</title>
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
                <!-- Formulário de cadastro de fornecedor -->
                <h2>
                    Cadastrar Fornecedor
                    <a href="fornecedores.php" class="btn btn-primary btn-sm">Novo Fornecedor</a>
                </h2>
                <form id="productForm" action="cadastrar-fornecedor.php" method="POST">
                    <div class="mb-3">
                        <label for="providerId" class="form-label">Código do Fornecedor</label>
                        <input type="text" class="form-control" id="providerId" name="providerId" readonly value="<?php echo isset($key) ? $key : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerName" class="form-label">Razão Social</label>
                        <input type="text" class="form-control" id="providerName" name="providerName" required value="<?php echo isset($provider) ? $provider["providerName"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerCNPJ" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" id="providerCNPJ" name="providerCNPJ" required value="<?php echo isset($provider) ? $provider["providerCNPJ"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerEmail" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="providerEmail" name="providerEmail" required value="<?php echo isset($provider) ? $provider["providerEmail"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerWhatsapp" class="form-label">Whatsapp</label>
                        <input type="text" class="form-control" id="providerWhatsapp" name="providerWhatsapp" required value="<?php echo isset($provider) ? $provider["providerWhatsapp"] : ""; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Tabela de fornecedores cadastrados -->
                <h2>Fornecedores Cadastrados</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Razão Social</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="providerTableBody">
                        <!-- Os fornecedores serão carregados aqui via PHP -->
                        <?php
                        // SE HOUVER FORNECEDORES NA SESSÃO, EXIBIR
                        if(!empty($_SESSION["fornecedores"])) {
                            foreach($_SESSION["fornecedores"] as $key => $provider) {
                                echo '
                                <tr>
                                    <th scope="row">'.($key + 1).'</th>
                                    <td>'.$provider["providerName"].'</td>
                                    <td>'.$provider["providerCNPJ"].'</td>
                                    <td>'.$provider["providerEmail"].'</td>
                                    <td>'.$provider["providerWhatsapp"].'</td>
                                    <td>
                                        <a href="fornecedores.php?key='.$key.'" class="btn btn-warning">Editar</a>
                                        <a href="remover-fornecedor.php?key='.$key.'" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="5">Nenhum fornecedor cadastrado</td>
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