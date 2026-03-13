<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Filmes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Meu Catálogo de Filmes</h1>
    <form action="buscar.php" method="GET">
        <input type="text" name="q" placeholder="Buscar filme..." required>
        <input type="submit" value="Buscar">
    </form>
    <p><a href="favoritos.php">Meus Favoritos</a></p>
</div>
</body>
</html>