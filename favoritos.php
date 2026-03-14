<?php require_once 'conexao.php'; 
$result = $conn->query("SELECT * FROM filmes_favoritos ORDER BY data_adicao DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meus Favoritos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Meus Favoritos (<?= $result->num_rows ?>)</h1>
    <p><a href="index.php">← Buscar filmes</a></p>

    <?php if ($result->num_rows == 0): ?>
        <p>Você ainda não adicionou nenhum filme.</p>
    <?php else: ?>
        <div class="card-container">
            <?php while ($f = $result->fetch_assoc()): ?>
                <div class="card">
                    <?php if ($f['poster_url']): ?>
                        <img src="<?= $f['poster_url'] ?>" alt="<?= htmlspecialchars($f['titulo']) ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/500x750?text=Sem+Poster">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($f['titulo']) ?> (<?= $f['ano_lancamento'] ?>)</h3>
                    
                    <div class="estrelas">
                        <form action="avaliar.php" method="POST">
                            <input type="hidden" name="id" value="<?= $f['api_filme_id'] ?>">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" name="estrelas" value="<?= $i ?>" id="star<?= $f['id'] . $i ?>" 
                                    <?= ($f['minha_avaliacao'] == $i) ? 'checked' : '' ?>>
                                <label for="star<?= $f['id'] . $i ?>">★</label>
                            <?php endfor; ?>
                            <br><textarea name="comentario" placeholder="Seu comentário..."><?= htmlspecialchars($f['meu_comentario'] ?? '') ?></textarea><br>
                            <button type="submit">Salvar Avaliação</button>
                        </form>
                    </div>
                    <p><a href="detalhes.php?id=<?= $f['api_filme_id'] ?>">Ver detalhes completos</a></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>