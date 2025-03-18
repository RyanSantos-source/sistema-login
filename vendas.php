<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "vendas";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $sale = $_SESSION["vendas"][$key];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Vendas</title>
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
                <!-- Formulário de cadastro de vendas -->
                <h2>
                    Cadastrar Venda
                    <a href="vendas.php" class="btn btn-primary btn-sm">Nova Venda</a>
                </h2>
                <form id="productForm" action="cadastrar-venda.php" method="POST">
                    <div class="mb-3">
                        <label for="saleId" class="form-label">Código da Venda</label>
                        <input type="text" class="form-control" id="saleId" name="saleId" readonly value="<?php echo isset($key) ? $key : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="saleName" class="form-label">Cliente</label>
                        <select id="saleName" name="saleName" class="form-select" required>
                            <option value="">Selecione um cliente</option>
                            <?php
                            foreach ($_SESSION["clientes"] as $key => $client) {
                                // SE A VARIÁVEL $sale EXISTIR E O NOME DO CLIENTE FOR 
                                // IGUAL AO NOME DO CLIENTE DA VENDA, SELECIONAR O CLIENTE
                                if(isset($sale) && $sale["saleName"] == $client["clientName"]) {
                                    echo '<option value="'.$client["clientName"].'" selected>'.$client["clientName"].'</option>';
                                } else {
                                    echo '<option value="'.$client["clientName"].'">'.$client["clientName"].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="saleProduct" class="form-label">Produto</label>
                        <select id="saleProduct" name="saleProduct" class="form-select" required>
                            <option value="">Selecione um produto</option>
                            <?php
                            foreach ($_SESSION["produtos"] as $key => $product) {
                                // SE A VARIÁVEL $sale EXISTIR E O NOME DO PRODUTO FOR
                                // IGUAL AO NOME DO PRODUTO DA VENDA, SELECIONAR O PRODUTO
                                if(isset($sale) && $sale["saleProduct"] == $product["productName"]) {
                                    echo '<option value="'.$product["productName"].'" selected>'.$product["productName"].'</option>';
                                } else {
                                    echo '<option value="'.$product["productName"].'">'.$product["productName"].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="saleDiscount" class="form-label">Desconto</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="number" class="form-control" id="saleDiscount" name="saleDiscount" required value="<?php echo isset($sale) ? $sale["saleDiscount"] : ""; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Tabela de clientes cadastrados -->
                <h2>Vendas Cadastradas</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="clientTableBody">
                        <!-- Os clientes serão carregados aqui via PHP -->
                        <?php
                        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
                        if(!empty($_SESSION["vendas"])) {
                            foreach($_SESSION["vendas"] as $key => $sale) {
                                echo '
                                <tr>
                                    <th scope="row">'.($key + 1).'</th>
                                    <td>'.$sale["saleName"].'</td>
                                    <td>'.$sale["saleProduct"].'</td>
                                    <td>'.$sale["saleDiscount"].'</td>
                                    <td>
                                        <a href="vendas.php?key='.$key.'" class="btn btn-warning">Editar</a>
                                        <a href="remover-venda.php?key='.$key.'" class="btn btn-danger">Excluir</a>
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