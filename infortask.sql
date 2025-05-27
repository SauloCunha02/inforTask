-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/05/2025 às 15:58
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `infortask`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `idAdm` int(11) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` enum('ativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `admin`
--

INSERT INTO `admin` (`idAdm`, `usuario`, `nome`, `senha`, `status`) VALUES
(1, 'Admin', 'Admin1', '$2y$10$L8RT4XVYMIoiayKL.5s/zerllW8Q6FED7pPgvN3NW/VHwwfY.mmke', 'ativo'),
(2, 'Admin', 'Admin2', '$2y$10$eFpVNHpqIppB0E0MRdRo1OPV2uE13k1figKPc93LzgA1F6APVXSGK', 'ativo'),
(3, 'Admin', 'Admin3', '$2y$10$ReCuf8szAAsaCVGEeXbUM.p56WFvG.orHRvg05b6FlcloTPHVFyau', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `idAluno` int(11) NOT NULL,
  `idTurma` int(11) DEFAULT NULL,
  `matricula` varchar(60) DEFAULT NULL,
  `nome` varchar(70) DEFAULT NULL,
  `usuario` varchar(60) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `status` enum('ativo','inativo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunosavaliacoes`
--

CREATE TABLE `alunosavaliacoes` (
  `idAluno` int(11) NOT NULL,
  `idAvaliacoes` int(11) NOT NULL,
  `nota` float(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `idAvaliacoes` int(11) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `dataAtual` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `statusAvaliacao` enum('ativo','inativo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoesquestoes`
--

CREATE TABLE `avaliacoesquestoes` (
  `idAvaliacoes` int(11) NOT NULL,
  `idQuestao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int(11) NOT NULL,
  `idCategoria` varchar(45) DEFAULT NULL,
  `nome` varchar(70) DEFAULT NULL,
  `descricao` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `idProfessor` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `usuario` varchar(150) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `status` enum('ativo','inativo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `nome`, `usuario`, `senha`, `status`) VALUES
(2, 'Henrique Alves Raulino', 'henrique01', '$2y$10$L9aaauGnJaqW/o77WEHBEONBMs37F8L.pohOD0thOftQgbXTtslxG', 'ativo'),
(6, 'teste 01', 'teste01', '$2y$10$vLIssmlDjBFe2kg8lkazNeKxHoVcL..eZrX5MhywFI7tV/0e6IxzK', 'inativo'),
(8, 'Outroteste', 'teste0555', '$2y$10$Omzq4NplHg77wPeA2/GTeetBGkOdJRoGq6WSlLzpN1VERlVnWb0HS', 'inativo'),
(10, 'Saulo', 'saulocunha01', '$2y$10$fMZfhn2MIMcAkeUPeZS1rOq4iR8Y/W7F0YbCdBan7Xl6xkb5FFYe.', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `questoes`
--

CREATE TABLE `questoes` (
  `idQuestao` int(11) NOT NULL,
  `idDisciplina` int(11) DEFAULT NULL,
  `idProfessor` int(11) DEFAULT NULL,
  `enunciado` varchar(255) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `tags` varchar(120) DEFAULT NULL,
  `dataAtual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `questoestens`
--

CREATE TABLE `questoestens` (
  `id` int(11) NOT NULL,
  `idQuestao` int(11) DEFAULT NULL,
  `alternativa` varchar(255) DEFAULT NULL,
  `alternativaCorreta` enum('sim','nao') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `idTurma` int(11) NOT NULL,
  `nome` varchar(70) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `status` enum('ativo','inativo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`idTurma`, `nome`, `descricao`, `status`) VALUES
(1, 'inforG7', 'Concluiu', 'inativo'),
(2, 'inforG8', 'Concluindo', 'inativo'),
(3, 'InforG9', '2024-2026', 'ativo'),
(4, 'InforG10', '2025-2027', 'ativo'),
(5, 'InforG11', 'Em andamento', 'inativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdm`);

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`idAluno`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `idTurma` (`idTurma`);

--
-- Índices de tabela `alunosavaliacoes`
--
ALTER TABLE `alunosavaliacoes`
  ADD PRIMARY KEY (`idAluno`,`idAvaliacoes`),
  ADD KEY `idAvaliacoes` (`idAvaliacoes`);

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`idAvaliacoes`);

--
-- Índices de tabela `avaliacoesquestoes`
--
ALTER TABLE `avaliacoesquestoes`
  ADD PRIMARY KEY (`idAvaliacoes`,`idQuestao`),
  ADD KEY `idQuestao` (`idQuestao`);

--
-- Índices de tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`idProfessor`);

--
-- Índices de tabela `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`idQuestao`),
  ADD KEY `idDisciplina` (`idDisciplina`),
  ADD KEY `idProfessor` (`idProfessor`);

--
-- Índices de tabela `questoestens`
--
ALTER TABLE `questoestens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idQuestao` (`idQuestao`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`idTurma`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `idAluno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `idAvaliacoes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `idProfessor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `questoes`
--
ALTER TABLE `questoes`
  MODIFY `idQuestao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `questoestens`
--
ALTER TABLE `questoestens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turmas` (`idTurma`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `alunosavaliacoes`
--
ALTER TABLE `alunosavaliacoes`
  ADD CONSTRAINT `alunosavaliacoes_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `alunos` (`idAluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alunosavaliacoes_ibfk_2` FOREIGN KEY (`idAvaliacoes`) REFERENCES `avaliacoes` (`idAvaliacoes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `avaliacoesquestoes`
--
ALTER TABLE `avaliacoesquestoes`
  ADD CONSTRAINT `avaliacoesquestoes_ibfk_1` FOREIGN KEY (`idAvaliacoes`) REFERENCES `avaliacoes` (`idAvaliacoes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avaliacoesquestoes_ibfk_2` FOREIGN KEY (`idQuestao`) REFERENCES `questoes` (`idQuestao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `questoes`
--
ALTER TABLE `questoes`
  ADD CONSTRAINT `questoes_ibfk_1` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `questoes_ibfk_2` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `questoestens`
--
ALTER TABLE `questoestens`
  ADD CONSTRAINT `questoestens_ibfk_1` FOREIGN KEY (`idQuestao`) REFERENCES `questoes` (`idQuestao`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
