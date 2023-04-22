-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 21-Abr-2023 às 17:08
-- Versão do servidor: 8.0.32-0ubuntu0.22.04.2
-- versão do PHP: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id` int NOT NULL,
  `dataEmprestimo` date NOT NULL,
  `usuario_id` int NOT NULL,
  `dataDevolucao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id`, `dataEmprestimo`, `usuario_id`, `dataDevolucao`) VALUES
(2, '2023-04-20', 1, '2023-04-22'),
(4, '2023-04-21', 4, NULL),
(5, '2023-04-22', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE `livro` (
  `id` int NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `autor` varchar(200) NOT NULL,
  `sessao_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`id`, `titulo`, `autor`, `sessao_id`) VALUES
(1, 'O Senhor dos Anéis - A Sociedade do Anel', 'J. R. R. Tolkien', 3),
(2, 'BRUCE DICKINSON: UMA AUTOBIOGRAFIA. Para que serve esse botão?', 'Bruce Dickinson', 3),
(3, 'Biografia Steve Harris , O Clarividente.', 'Stjepan Juras', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livroEmprestimo`
--

CREATE TABLE `livroEmprestimo` (
  `livro_id` int NOT NULL,
  `emprestimo_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `livroEmprestimo`
--

INSERT INTO `livroEmprestimo` (`livro_id`, `emprestimo_id`) VALUES
(1, 2),
(2, 5),
(3, 2),
(3, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessao`
--

CREATE TABLE `sessao` (
  `id` int NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `localizacao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `sessao`
--

INSERT INTO `sessao` (`id`, `descricao`, `localizacao`) VALUES
(3, 'Literatura Estrangeira', 'Primeiro andar - corredor B2'),
(4, 'Literatura Brasileira', 'Primeiro andar - corredor A1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `endereco`, `telefone`) VALUES
(1, 'Marcelo Corrêa Mussel', 'marcelo.mussel@gmail.com', 'Rua Dona Leopoldina, 112', '(35)98835-0625'),
(2, 'Jovenildo Aristóteles da Silva', 'jojo@gmail.com', 'Avenida dos Imigrantes, 1180', '(35)99999-9999'),
(4, 'Epaminondas Corrêa Dutra', 'epa@gmail.com', 'Avenida dos Imigrantes, 1500', '(35)88888-8888');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`usuario_id`);

--
-- Índices para tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sessao` (`sessao_id`);

--
-- Índices para tabela `livroEmprestimo`
--
ALTER TABLE `livroEmprestimo`
  ADD PRIMARY KEY (`livro_id`,`emprestimo_id`);

--
-- Índices para tabela `sessao`
--
ALTER TABLE `sessao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sessao`
--
ALTER TABLE `sessao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `fk_sessao` FOREIGN KEY (`sessao_id`) REFERENCES `sessao` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
