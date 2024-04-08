<?php
require_once 'config.php';

switch ($_REQUEST['action']) {
    case 'cadastrar':
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data_de_nascimento = $_POST['data_de_nascimento'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];

        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, `data de nascimento`, telefone, cpf) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nome, $email, $data_de_nascimento, $telefone, $cpf);
        $res = $stmt->execute();

        if (!$res) {
            die("Erro ao inserir: " . $conn->error);
        }
        header("Location: usuarios.php");
        exit;
        break;

        case 'editar':
         $nome = $_POST['nome'];
         $email = $_POST['email'];
         $data_de_nascimento = $_POST['data_de_nascimento'];
         $telefone = $_POST['telefone'];
         $cpf = $_POST['cpf'];
         $id = $_GET['id'];
         //$stmt = $conn->prepare("UPDATE usuarios SET nome='$nome', email='$email', data_de_nascimento='$data_de_nascimento', telefone='$telefone', cpf='$cpf' WHERE id=");
         $stmt = $conn->prepare("UPDATE usuarios SET data_de_nascimento='$data_de_nascimento', cpf='$cpf' WHERE id='$id'");
         $stmt->bind_param("sssssi", $nome, $email, $data_de_nascimento, $telefone, $cpf, $id);

         $res = $stmt->execute();
     
         if (!$res) {
             die("Erro ao atualizar: " . $conn->error);
         }
         header("Location: usuarios.php");
         exit;
         break;

    case 'excluir':
        $sql  = "DELETE FROM `usuario` WHERE id=".$_REQUEST["id"];
        $res  = $conn->query($sql);
        if($res === true){
         print "<script> alert('Excluido com sucesso');</script>";
         print "<script>location.href='?page=listar';</script>";
       }else{
         print "<script> alert('Não foi possivel excluir');</script>";
         print "<script>location.href='?page=listar';</script>";
        break;
}
}
?>

<!-- Modal -->
<div id="cadastroRealizadoModal" class="modal">
 <div class="modal-content">
    <span class="close">&times;</span>
    <p>Cadastro realizado com sucesso!</p>
 </div>
</div>

<script>
// Quando a página é carregada, verifique se o cadastro foi realizado com sucesso
document.addEventListener("DOMContentLoaded", function() {
 var modal = document.getElementById("cadastroRealizadoModal");
 var span = document.getElementsByClassName("close")[0];

 // Quando o usuário clica em <span> (x), feche o modal
 span.onclick = function() {
    modal.style.display = "none";
 }

 // Quando o usuário clica fora do modal, feche-o
 window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
 }

 // Mostre o modal se o cadastro foi realizado com sucesso
 if (window.location.search.indexOf('cadastro=sucesso') > -1) {
    modal.style.display = "block";
 }
});
</script>
