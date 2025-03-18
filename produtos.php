<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "produtos";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $product = $_SESSION["produtos"][$key];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Produtos</title>
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
                <!-- Formulário de cadastro de produtos -->
                <h2>
                    Cadastrar Produto
                    <a href="index.php" class="btn btn-primary btn-sm">Novo Produto</a>
                </h2>
                <!-- ENCTYPE = PERMITE O ENVIO DE ARQUIVOS JUNTO COM O FORMULÁRIO -->
                <form enctype="multipart/form-data" id="productForm" action="cadastrar-produto.php" method="POST">
                    <div class="mb-3">
                        <label for="productId" class="form-label">Código do Produto</label>
                        <input type="text" class="form-control" id="productId" name="productId" readonly value="<?php echo isset($key) ? $key : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="productName" name="productName" required value="<?php echo isset($product) ? $product["productName"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Descrição</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required><?php echo isset($product) ? $product["productDescription"] : ""; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" name="productPrice" required value="<?php echo isset($product) ? $product["productPrice"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" required value="<?php echo isset($product) ? $product["productQuantity"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" value="<?php echo isset($product) ? $product["productImage"] : ""; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Tabela de produtos cadastrados -->
                <h2>Produtos Cadastrados</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <!-- Os produtos serão carregados aqui via PHP -->
                        <?php
                        // SE HOUVER PRODUTOS NA SESSÃO, EXIBIR
                        if(!empty($_SESSION["produtos"])) {
                            foreach($_SESSION["produtos"] as $key => $product) {
                                echo '
                                <tr>
                                    <th scope="row">'.($key + 1).'</th>
                                    <td><img width="60" src="imagens/'.$product["productImage"].'"></td>
                                    <td>'.$product["productName"].'</td>
                                    <td>'.$product["productDescription"].'</td>
                                    <td>R$ '.number_format($product["productPrice"],2,',','.').'</td>
                                    <td>'.$product["productQuantity"].'</td>
                                    <td>
                                        <a href="produtos.php?key='.$key.'" class="btn btn-warning">Editar</a>
                                        <a href="remover-produto.php?key='.$key.'" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="5">Nenhum produto cadastrado</td>
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