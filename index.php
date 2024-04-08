<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Cadastro</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
 <div class="container-fluid">
    <a class="navbar-brand" href="#">Cadastro</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=novo">Novo Cadastro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=listar">Listar Usuários</a>
        </li>
      </ul>
    </div>
 </div>
</nav>
<div class="container">
    <div class="row">
        <div class=" col mt-5">
        <?php
require_once 'config.php';
        switch(@$_REQUEST	['page']){
            case "novo":
            include("novocadastro.php");
            break;
        case"listar":
            include ("usuarios.php");
            break;
            case "salvar":
                include("salvar-cadastro.php");
                break;
          case "editar":
                  include("editar-usuario.php");
                  break;
            default:
            print "<h1>Bem vindo!</h1>";
        }?>
    </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>