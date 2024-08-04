<?php
include('mysql.php');

$nome_da_tarefa = $_POST['nome_da_tarefa'];

$sucesso = "INSERT INTO tarefas (nome_da_tarefa)  VALUES ('$nome_da_tarefa')";

if ($conexao->query($sucesso) === TRUE){
    header('Location: index.html');

  } else {
    echo '<p>Erro ao cadastrar a tarefa: ' . mysqli_error($conexao) . '</p>';
  }

mysqli_close($conexao);

?>