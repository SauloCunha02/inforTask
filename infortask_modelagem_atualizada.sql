
CREATE DATABASE IF NOT EXISTS infortask;
USE infortask;

-- Tabela admin
CREATE TABLE `admin` (
  `idAdm` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario` varchar(60) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` enum('ativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Tabela turmas
CREATE TABLE turmas (
    idTurma INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(70),
    descricao VARCHAR(100),
    status ENUM('ativo', 'inativo')
);

-- Tabela professores
CREATE TABLE professor (
    idProfessor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    usuario VARCHAR(150),
    senha VARCHAR(255),
    status ENUM('ativo', 'inativo')
);

-- Tabela disciplinas
CREATE TABLE disciplina (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCategoria VARCHAR(45),
    nome VARCHAR(70),
    descricao VARCHAR(120)
);

-- Tabela alunos
CREATE TABLE alunos (
    idAluno INT AUTO_INCREMENT PRIMARY KEY,
    idTurma INT,
    matricula VARCHAR(60) UNIQUE,
    nome VARCHAR(70),
    usuario VARCHAR(60) UNIQUE,
    senha VARCHAR(255),
    status ENUM('ativo', 'inativo'),
    FOREIGN KEY (idTurma) REFERENCES turmas(idTurma)
        ON DELETE SET NULL ON UPDATE CASCADE
);

-- Tabela avaliacoes
CREATE TABLE avaliacoes (
    idAvaliacoes INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60),
    dataAtual DATE,
    dataFinal DATE,
    statusAvaliacao ENUM('ativo', 'inativo')
);

-- Tabela alunosAvaliacoes
CREATE TABLE alunosAvaliacoes (
    idAluno INT,
    idAvaliacoes INT,
    nota FLOAT(5,2),
    PRIMARY KEY (idAluno, idAvaliacoes),
    FOREIGN KEY (idAluno) REFERENCES alunos(idAluno)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idAvaliacoes) REFERENCES avaliacoes(idAvaliacoes)
        ON DELETE CASCADE ON UPDATE CASCADE
);


-- Tabela questoes
CREATE TABLE questoes (
    idQuestao INT AUTO_INCREMENT PRIMARY KEY,
    idDisciplina INT,
    idProfessor INT,
    enunciado VARCHAR(255),
    foto TEXT,
    tags VARCHAR(120),
    dataAtual DATE,
    FOREIGN KEY (idDisciplina) REFERENCES disciplina(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (idProfessor) REFERENCES professor(idProfessor)
        ON DELETE SET NULL ON UPDATE CASCADE
);

-- Tabela avaliacoesQuestoes
CREATE TABLE avaliacoesQuestoes (
    idAvaliacoes INT,
    idQuestao INT,
    PRIMARY KEY (idAvaliacoes, idQuestao),
    FOREIGN KEY (idAvaliacoes) REFERENCES avaliacoes(idAvaliacoes)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idQuestao) REFERENCES questoes(idQuestao)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabela questoestens (agora alternativas)
CREATE TABLE questoestens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idQuestao INT,
    alternativa VARCHAR(255),
    alternativaCorreta ENUM('sim', 'nao'),
    FOREIGN KEY (idQuestao) REFERENCES questoes(idQuestao)
        ON DELETE CASCADE ON UPDATE CASCADE
);
