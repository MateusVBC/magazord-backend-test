SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "-03:00";

--
-- Banco de dados: `magazord`
--
-- Estrutura da tabela de Pessoa
CREATE TABLE `Pessoa` (
  `id` int(11) AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(11) UNIQUE NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Estrutura da tabela de Contato
CREATE TABLE `Contato` (
  `id` int(11) AUTO_INCREMENT,
  `tipo` boolean NOT NULL,
  `descricao` varchar(50) UNIQUE NOT NULL,
  `idPessoa` int UNIQUE NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

ALTER TABLE
  `Contato`
ADD
  CONSTRAINT FK_idPessoa FOREIGN KEY (`idPessoa`) REFERENCES Pessoa(`id`) ON DELETE CASCADE;