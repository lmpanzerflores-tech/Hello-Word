<?php
require_once 'config.php';

if (!isset($_GET['q']) || empty(trim($_GET['q']))) {
    header('Location: index.php');
    exit;
}

$query = urlencode($_GET['q']);
$url = "https://api.themoviedb.org/3/search/movie?api_key=" . TMDB_API_KEY . "&query={$query}&language=pt-BR";

$json = file_get_contents($url);
$data = json_decode($json, true);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultados para "<?= htmlspecialchars($_GET['q']) ?>"</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Resultados para "<?= htmlspecialchars($_GET['q']) ?>"</h1>
    <p><a href="index.php">← Nova busca</a> | <a href="favoritos.php">Meus Favoritos</a></p>

    <?php if (empty($data['results'])): ?>
        <p>Nenhum filme encontrado.</p>
    <?php else: ?>
        <div class="card-container">
            <?php foreach ($data['results'] as $filme): 
                $poster = $filme['poster_path'] 
                    ? "https://image.tmdb.org/t/p/w500" . $filme['poster_path']
                    : 'https://via.placeholder.com/500x750?text=Sem+Poster';
                $ano = substr($filme['release_date'], 0, 4) ?: 'N/A';
            ?>
                <div class="card">
                    <img src="<?= $poster ?>" alt="<?= htmlspecialchars($filme['title']) ?>">
                    <h3><?= htmlspecialchars($filme['title']) ?></h3>
                    <p><?= $ano ?></p>
                    <form action="adicionar_favorito.php" method="POST">
                        <input type="hidden" name="id" value="<?= $filme['id'] ?>">
                        <input type="hidden" name="titulo" value="<?= htmlspecialchars($filme['title']) ?>">
                        <input type="hidden" name="poster" value="<?= $filme['poster_path'] ?>">
                        <input type="hidden" name="ano" value="<?= $ano ?>">
                        <button type="submit">Adicionar aos Favoritos</button>
                    </form>
                    <p><a href="detalhes.php?id=<?= $filme['id'] ?>">Ver detalhes</a></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>