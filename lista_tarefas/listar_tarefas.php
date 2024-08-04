<?php

include('mysql.php');

$pesquisa = isset($_GET['termo_busca']) ? $_GET['termo_busca'] : '';
$sucesso = mysqli_query($conexao, "SELECT id, nome_da_tarefa, concluida FROM tarefas WHERE nome_da_tarefa LIKE '%$pesquisa%' ORDER BY concluida ASC");

if (isset($_POST['id_tarefa']) && isset($_POST['concluida'])) {
    $id_tarefa = $_POST['id_tarefa'];
    $concluida = $_POST['concluida'];

    mysqli_query($conexao, "UPDATE tarefas SET concluida = $concluida WHERE id = $id_tarefa");
}

if ($sucesso) {
    echo "<ul class='list'>";
    while ($linha = mysqli_fetch_assoc($sucesso)) {
        echo "<div class='list_item'>";

        $checked = $linha['concluida'] == 1 ? 'checked' : '';
        echo "<input class='checkbox' type='checkbox' name='concluir_tarefa' value='{$linha['id']}' onchange='concluirTarefa(this)' $checked>";

        $concluida = $linha['concluida'] == 1 ? 'concluida' : '';
        echo "<li class='$concluida'>";
        echo $linha['nome_da_tarefa'];
        echo "</li>";

        echo "<button class='button delete' onclick='deleteTarefa(" . $linha['id'] . ")'>Apagar</button>";

        echo "</div>";
    }
    echo "</ul>";
} else {
    echo "Erro na consulta: " . mysqli_error($conexao);
}

mysqli_close($conexao);
?>




<script>
    function concluirTarefa(checkbox) {
        var idTarefa = checkbox.value;
        var isChecked = checkbox.checked;

        $.ajax({
            type: "POST",
            url: "listar_tarefas.php",
            data: { id_tarefa: idTarefa, concluida: isChecked ? 1 : 0 },
            success: function () {
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error("Erro na requisição AJAX: " + error);
            }
        });
    }
</script>