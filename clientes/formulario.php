<?php
include "../verificar-autenticacao.php";
$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/clientes/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $client = $response["data"][0];
    } else {
        $client = null;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
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
                    <div class="card-header bg-primary text-white">
                        Cadastro de Clientes
                    </div>
                    <form id="clientForm" action="/clientes/cadastrar.php" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="clientId" class="form-label">Código do Cliente</label>
                                    <input type="text" class="form-control" id="clientId" name="id_cliente" readonly
                                        value="<?php echo isset($client) ? $client["id_cliente"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="nome" class="form-label">Nome do Cliente</label>
                                    <input type="text" class="form-control" id="nome" name="nome" required
                                        value="<?php echo isset($client) ? $client["nome"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input data-mask="000.000.000-00" type="text" class="form-control" id="cpf"
                                        name="cpf" required value="<?php echo isset($client) ? $client["cpf"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        value="<?php echo isset($client) ? $client["email"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="whatsapp" class="form-label">Whatsapp</label>
                                    <input data-mask="(00) 0 0000-0000" type="text" class="form-control" id="whatsapp"
                                        name="whatsapp" required
                                        value="<?php echo isset($client) ? $client["whatsapp"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="imagem" class="form-label">Imagem</label>
                                    <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                                    <?php
                                    if (isset($client["imagem"])) {
                                        echo '
                                            <input type="hidden" name="currentClientImage" value="' . $client["imagem"] . '">
                                            <img width="100" class="mt-2" src="imagens/' . $client["imagem"] . '">
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="cep" class="form-label">CEP</label>
                                    <input data-mask="00000-000" type="text" class="form-control" id="cep" name="cep"
                                        required
                                        value="<?php echo isset($client) ? $client["endereco"]["cep"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="logradouro" class="form-label">Logradouro</label>
                                    <input type="text" class="form-control" id="logradouro" name="logradouro" required
                                        value="<?php echo isset($client) ? $client["endereco"]["logradouro"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="numero" class="form-label">Número</label>
                                    <input type="text" class="form-control" id="numero" name="numero" required
                                        value="<?php echo isset($client) ? $client["endereco"]["numero"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="complemento" class="form-label">Complemento</label>
                                    <input type="text" class="form-control" id="complemento" name="complemento"
                                        value="<?php echo isset($client) ? $client["endereco"]["complemento"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" required
                                        value="<?php echo isset($client) ? $client["endereco"]["bairro"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" required
                                        value="<?php echo isset($client) ? $client["endereco"]["cidade"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="estado" class="form-label">Estado</label>
                                    <input maxlength="2" type="text" class="form-control" id="estado" name="estado"
                                        required
                                        value="<?php echo isset($client) ? $client["endereco"]["estado"] : ""; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="/clientes/index.php" class="btn btn-danger">Voltar</a>
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
        }
    });
    </script>
</body>

</html>