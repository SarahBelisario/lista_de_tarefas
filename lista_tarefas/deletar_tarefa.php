<?php
include('mysql.php');

$id = $_POST['id'];

if ($id) {
    $sucesso = "DELETE FROM tarefas WHERE id = $id";

    if ($conexao->query($sucesso) === TRUE) {
        header('Location: index.html');
        
    } else {
        echo "Erro ao deletar a tarefa: " . mysqli_error($conexao);
    }
} else {
    echo "ID da tarefa não fornecido.";
}

mysqli_close($conexao);
?>
