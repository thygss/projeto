<?php
require_once 'config.php'; // Certifique-se de que esta linha esteja no início do arquivo

ob_start(); // Inicia o buffer de saída
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $_REQUEST['id']);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_object();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a ação é "cadastrar"
    if ($_POST['acao'] == 'cadastrar') {
        // Lógica para cadastrar um novo usuário
    }
    // Verifica se a ação é "editar"
    elseif ($_POST['acao'] == 'editar') {
        // Definir as variáveis com os valores enviados pelo formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];

        // Processar os dados do formulário aqui
        // Por exemplo, atualizar os dados no banco de dados
        $data_de_nascimento = strtotime($_POST['data_de_nascimento']);
        if ($data_de_nascimento === false) {
            die("Data de nascimento inválida.");
        }
        $data_de_nascimento = date('Y-m-d', $data_de_nascimento);
        $sql = "UPDATE usuarios SET nome = ?, email = ?, `data de nascimento` = ?, telefone = ?, cpf = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nome, $email, $data_de_nascimento, $telefone, $cpf, $_REQUEST['id']);
        $stmt->execute();
        if (!$stmt) {
            die("Erro ao atualizar: " . $conn->error);
        }
    }
    header("Location: usuarios.php");
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php

    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Editar Usuário</h1>
                <form action="editar-usuario.php" method="post" class="mb-3">
                    <input type="hidden" name="acao" value="editar"> 
                    <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                    <div class="form-group mb-3">
                        <label for="nome" class="form-label">Nome: <span class="text-danger">*</span></label>
                        <input type="text" id="nome" name="nome" value="<?php print $row->nome; ?>" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">E-mail: <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" value="<?php print $row->email; ?>" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="data_de_nascimento" class="form-label">Data de Nascimento: <span class="text-danger">*</span></label>
                        <input type="date" id="data_de_nascimento" name="data_de_nascimento" value="<?php print $row->data_de_nascimento ; ?>" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="telefone" class="form-label">Telefone: <span class="text-danger">*</span> (somente números)</label>
                        <input type="tel" id="telefone" name="telefone" value="<?php print $row->telefone; ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cpf" class="form-label">CPF: <span class="text-danger">*</span>(Apenas números)</label>
                        <input type="text" id="cpf" name="cpf" class="form-control" value="<?php print $row->cpf; ?>" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="agradecimentoModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Obrigado pelo cadastro!</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('telefone').addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });
        document.getElementById('cpf').addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
            e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + (x[3] ? '.' + x[3] : '') + (x[4] ? '-' + x[4] : '');
        });

        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("agradecimentoModal");
            var span = document.getElementsByClassName("close")[0];

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            if (window.location.search.indexOf('cadastro=sucesso') > -1) {
                modal.style.display = "block";
            }
        });
    </script>
</body>
</html>