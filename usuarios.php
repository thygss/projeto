<?php
// Inclua o arquivo de configuração que contém a lógica de conexão
include 'config.php';

// Defina a variável $mysqli com a conexão estabelecida
$mysqli = $conn;

// Execute a consulta SQL
$sql = "SELECT * FROM usuarios";
$resultado = $mysqli->query($sql);

// Verifique se a consulta foi executada com sucesso
if ($resultado === false) {
    die("Erro ao executar a consulta: " . $mysqli->error);
}

// Agora você pode usar $resultado para buscar os objetos
$qtd = $resultado->num_rows; //quantidade de linhas do resultado da consulta.

if ($qtd > 0) {
    print "<table class='table table-striped'>"; // Adiciona classes do Bootstrap para estilização
    print "<thead>";
    print "<tr>"; // Adicionei a tag <tr> faltante aqui
    print "<th>Nome</th>";
    print "<th>Email</th>";
    print "<th>Telefone</th>";
    print "<th>Ações</th>";
    print "</tr>";
    print "</thead>";
    print "<tbody>";
    while ($row = $resultado->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->nome . "</td>";
        print "<td>" . $row->email . "</td>";
        print "<td>" . $row->telefone . "</td>";
        print "<td>";
        print "<button onclick=\"window.location.href='editar-usuario.php?id=" . $row->id . "';\" class='btn btn-primary'>Editar</button>";
        print "<button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='excluir-usuario.php?id=".$row->id."';}else{false;} \" class='btn btn-danger'>Excluir</button>";
        print "</td>";
        print "</tr>";
    }
    print "</tbody>";
    print "</table>";
} else {
    print "<p class='alert alert-danger'>Não encontrou resultados.</p>";
}
?>