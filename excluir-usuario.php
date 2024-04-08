<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        
        header("Location: usuarios.php");
        exit;
    } else {
        echo "Erro ao excluir o usuário.";
    }
} else {
    echo "ID do usuário não fornecido.";
}
?>