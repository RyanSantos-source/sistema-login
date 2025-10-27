<?php
include "../verificar-autenticacao.php";
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
$key = null;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Cadastrar Produto</h5>
                        <a href="./" class="btn btn-primary btn-sm">Novo Produto</a>
                    </div>
                    <form id="clientForm" action="/produto/cadastrar.php" method="POST">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="id_produto" class="form-label">Código do Produto</label>
                                    <input type="text" class="form-control" id="id_produto" name="id_produto" readonly
                                        value="<?php echo isset($produto) ? $produto["id_produto"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="produto" class="form-label">Nome do Produto</label>
                                    <input type="text" class="form-control" id="produto" name="produto" required
                                        value="<?php echo isset($produto) ? $produto["produto"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao" required
                                        value="<?php echo isset($produto) ? $produto["descricao"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="id_marca" class="form-label">Marca</label>
                                    <select class="form-control" id="id_marca" name="id_marca" required>
                                        <option value="">Selecione uma marca</option>
                                        <?php
                                        require("../requests/marca/get.php");
                                        if(isset($response["data"])) {
                                            foreach ($response["data"] as $marca) {
                                                $selected = isset($produto) && $produto["id_marca"] == $marca["id_marca"] ? "selected" : "";
                                                echo '<option value="' . $marca["id_marca"] . '" ' . $selected . '>' . $marca["marca"] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">Nenhuma marca cadastrada</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="quantidade" class="form-label">Quantidade</label>
                                    <input type="number" class="form-control" id="quantidade" name="quantidade" required
                                        value="<?php echo isset($produto) ? $produto["quantidade"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="preco" class="form-label">Preço</label>
                                    <input type="text" class="form-control" id="preco" name="preco" required
                                        value="<?php echo isset($produto) ? $produto["preco"] : ""; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="/produto/index.php" class="btn btn-danger">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#preco').mask('#.##0,00', {
            reverse: true
        });
    });
    </script>
</body>

</html>