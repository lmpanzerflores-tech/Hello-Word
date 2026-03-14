<?php
// config.php - Arquivo de configuração (NÃO commitar no Git!)

define('TMDB_API_KEY', '5dc036ddfbaa59d7be9ecb0875e59500');

// Configuração do banco de dados MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // mude se o seu usuário for diferente
define('DB_PASS', '');            // coloque a senha do MySQL aqui (deixe vazio se não tiver)
define('DB_NAME', 'filmes_db');   // nome do banco que você criou

// (Opcional) Configuração extra para evitar avisos
date_default_timezone_set('America/Sao_Paulo');
?>