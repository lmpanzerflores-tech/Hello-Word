<?php
require_once 'config.php';
if (!isset($_GET['id'])) exit('ID não informado');

$url = "https://api.themoviedb.org/3/movie/{$_GET['id']}?api_key=" . TMDB_API_KEY . "&language=pt-BR&append_to_response=credits,videos";
$json = file_get_contents($url);
$filme = json_decode($json, true);

$poster = $filme['poster_path'] ? "https://image.tmdb.org/t/p/w500" . $filme['poster_path'] : null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($filme['title']) ?></title>
    <link rel="stylesheet" href="style.css">
    <style>.detalhes { display: flex; gap: 30px; } .info { flex: 2; } iframe { width: 100%; height: 400px; }</style>
</head>
<body>
<div class="container">
    <p><a href="javascript:history.back()">← Voltar</a></p>
    <div class="detalhes">
        <?php if ($poster): ?><img src="<?= $poster ?>" width="300"><?php endif; ?>
        <div class="info">
            <h1><?= htmlspecialchars($filme['title']) ?> (<?= substr($filme['release_date'],0,4) ?>)</h1>
            <p><strong>Sinopse:</strong> <?= htmlspecialchars($filme['overview'] ?: 'Não disponível') ?></p>
            <p><strong>Gêneros:</strong> <?= implode(', ', array_column($filme['genres'], 'name')) ?></p>
            
            <h3>Diretor</h3>
            <?php
            $diretor = array_filter($filme['credits']['crew'], fn($p) => $p['job'] === 'Director');
            echo implode(', ', array_column($diretor, 'name')) ?: 'Não informado';
            ?>

            <h3>Elenco Principal</h3>
            <ul>
                <?php foreach (array_slice($filme['credits']['cast'], 0, 10) as $ator): ?>
                    <li><?= htmlspecialchars($ator['name']) ?> como <?= htmlspecialchars($ator['character']) ?></li>
                <?php endforeach; ?>
            </ul>

            <?php
            $trailer = null;
            foreach ($filme['videos']['results'] as $video) {
                if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer') {
                    $trailer = $video['key'];
                    break;
                }
            }
            if ($trailer): ?>
                <h3>Trailer</h3>
                <iframe src="https://www.youtube.com/embed/<?= $trailer ?>" allowfullscreen></iframe>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>