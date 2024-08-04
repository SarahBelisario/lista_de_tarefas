<?php
$hostname = "localhost";
$user = "root";
$password = "";
$database = "id21532763_tarefa";

$conexao = mysqli_connect($hostname, $user, $password, $database);

if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>
