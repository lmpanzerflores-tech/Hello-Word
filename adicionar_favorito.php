<?php
require_once 'conexao.php';

if ($_POST['id'] && $_POST['titulo']) {
    $stmt = $conn->prepare("INSERT INTO filmes_favoritos (api_filme_id, titulo, poster_url, ano_lancamento) 
                            VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE titulo=titulo");
    $poster_url = $_POST['poster'] ? "https://image.tmdb.org/t/p/w500" . $_POST['poster'] : null;
    $stmt->bind_param("issi", $_POST['id'], $_POST['titulo'], $poster_url, $_POST['ano']);
    $stmt->execute();
}
header('Location: favoritos.php');
exit;
?>