<?php
require_once 'conexao.php';

if (isset($_POST['id'])) {
    $estrelas = $_POST['estrelas'] ?? null;
    $comentario = $_POST['comentario'] ?? null;

    $stmt = $conn->prepare("UPDATE filmes_favoritos SET minha_avaliacao = ?, meu_comentario = ? WHERE api_filme_id = ?");
    $stmt->bind_param("isi", $estrelas, $comentario, $_POST['id']);
    $stmt->execute();
}
header('Location: favoritos.php');
exit;
?>