<h1>Obrigado</h1>
<?php
require_once 'config.php';
 switch ($_REQUEST['action']) {
    case 'cadastrar':
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data_de_nascimento = $_POST['data_de_nascimento'];
        $telefone = $_POST['telefone'];
        $cpf  = $_POST['cpf'];
        $sql = "INSERT INTO usuarios (nome, email, `data de nascimento`, telefone, cpf) VALUES ('{$nome}','{$email}','{$data_de_nascimento}', '{$telefone}', '{$cpf}')";
        $res = $conn->query($sql);
        if (!$res) {
            die("Erro ao inserir: " . $conn->error);
        }
        header("Location: pagina_de_agradecimento.php");
        exit;
        break;
    case 'editar':
        break;
    case  'excluir':
        break;
        }
?>