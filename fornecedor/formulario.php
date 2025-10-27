<?php
include "../verificar-autenticacao.php";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Cadastrar Fornecedor</h2>
                        <a href="./" class="btn btn-primary btn-sm">Novo Fornecedor</a>
                    </div>
                    <form id="clientForm" action="/fornecedor/cadastrar.php" method="POST"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="id_fornecedor" class="form-label">Código do Fornecedor</label>
                                    <input type="text" class="form-control" id="id_fornecedor" name="id_Fornecedor"
                                        readonly
                                        value="<?php echo isset($fornecedor) ?$fornecedor["id_fornecedor"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="razao_social" class="form-label">Razão Social</label>
                                    <input onblur="teste()" type="text" class="form-control" id="razao_social"
                                        name="razao_social" required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["razao_social"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="cnpj" class="form-label">CNPJ</label>
                                    <input data-mask="00.000.000/0000-00" type="text" class="form-control" id="cnpj"
                                        name="cnpj" required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["cnpj"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input data-mask="(00) 0 0000-0000" type="text" class="form-control" id="telefone"
                                        name="telefone" required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["telefone"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["email"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="cep" class="form-label">CEP</label>
                                    <input data-mask="00000-000" type="text" class="form-control" id="cep" name="cep"
                                        required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["endereco"]["cep"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="logradouro" class="form-label">Logradouro</label>
                                    <input type="text" class="form-control" id="logradouro" name="logradouro" required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["endereco"]["logradouro"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="clientNumber" class="form-label">Número</label>
                                    <input type="text" class="form-control" id="clientNumber" name="numero" required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["endereco"]["numero"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="clientComplement" class="form-label">Complemento</label>
                                    <input type="text" class="form-control" id="clientComplement" name="complemento"
                                        value="<?php echo isset($fornecedor) ?$fornecedor["endereco"]["complemento"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["endereco"]["bairro"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["endereco"]["cidade"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="estado" class="form-label">Estado</label>
                                    <input maxlength="2" type="text" class="form-control" id="estado" name="estado"
                                        required
                                        value="<?php echo isset($fornecedor) ?$fornecedor["endereco"]["estado"] : ""; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="/fornecedor/index.php" class="btn btn-danger">Voltar</a>
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
    $('#cep').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep.length === 8) {
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                if (!data.erro) {
                    $('#logradouro').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                    $("#cep").val("");
                    $("#logradouro").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#estado").val("");
                }
            });
        } else {
            alert('Formato de CEP inválido.');
            $("#cep").val("");
            $("#logradouro").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val("");
        }
    });
    </script>
</body>

</html>