CREATE DATABASE filmes_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE filmes_db;

CREATE TABLE filmes_favoritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    api_filme_id INT UNIQUE NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    poster_url VARCHAR(255),
    ano_lancamento YEAR,
    minha_avaliacao INT CHECK (minha_avaliacao BETWEEN 1 AND 5),
    meu_comentario TEXT,
    data_adicao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);