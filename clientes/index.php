<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
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

                <!-- card -->

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-rigth">
                        <h2>
                            Clientes Cadastrados
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
                                    <th scope="col">Nome</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Whatsapp</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="clientTableBody">
                                <!-- Os clientes serão carregados aqui via PHP -->
                                <?php
                        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
                        $key = null; //limpando a variável $key para trazer todos os clientes
                        require("../requests/clientes/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $key => $client) {
                                echo '
                                <tr>
                                    <th scope="row">' . ($client["id_cliente"]) . '</th>
                                    <td>' . $client["nome"] . '</td>
                                    <td>' . $client["cpf"] . '</td>
                                    <td>' . $client["email"] . '</td>
                                    <td>' . $client["whatsapp"] . '</td>
                                    <td>
                                        <a href="/clientes/formulario.php?key=' . $client["id_cliente"] . '" class="btn btn-warning">Editar</a>
                                        <a href="/clientes/remover.php?key=' . $client["id_cliente"] . '" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="7">Nenhum cliente cadastrado</td>
                            </tr>
                            ';
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- fim card -->

                <!-- Tabela de clientes cadastrados -->


            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- dataTables -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
    let table = new DataTable('#tabela', {
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
        }
    });
    </script>

    <script>
    $('#clientCEP').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        // Verifica se o CEP tem 8 dígitos
        if (cep.length === 8) {
            // Faz a requisição para a API ViaCEP
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                if (!data.erro) {
                    $('#clientStreet').val(data.logradouro);
                    $('#clientNeighborhood').val(data.bairro);
                    $('#clientCity').val(data.localidade);
                    $('#clientState').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                    $("#clientCEP").val("");
                    $("#clientStreet").val("");
                    $("#clientNeighborhood").val("");
                    $("#clientCity").val("");
                    $("#clientState").val("");
                }
            });
        } else {
            alert('Formato de CEP inválido.');
            // Limpa os campos de endereço
            $("#clientCEP").val("");
            $("#clientStreet").val("");
            $("#clientNeighborhood").val("");
            $("#clientCity").val("");
            $("#clientState").val("");
        }
    });
    </script>


</body>

</html>