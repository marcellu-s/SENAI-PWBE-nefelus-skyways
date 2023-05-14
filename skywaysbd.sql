-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Maio-2023 às 03:37
-- Versão do servidor: 8.0.32
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `skywaysbd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aeroporto`
--

CREATE TABLE `aeroporto` (
  `id_aeroporto` int NOT NULL,
  `sigla` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `fk_cidade` int NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aeroporto`
--

INSERT INTO `aeroporto` (`id_aeroporto`, `sigla`, `nome`, `fk_cidade`, `latitude`, `longitude`) VALUES
(1, 'CGH', 'Aeroporto Internacional de Congonhas', 4, -23.6267, -46.6553),
(2, 'GIG', 'Aeroporto Internacional do Rio de Janeiro-Galeão', 2, -22.8089, -43.2436),
(3, 'CNF', 'Aeroporto Internacional Tancredo Neves', 3, -19.6336, -43.9686),
(4, 'FLN', 'Aeroporto Internacional Hercílio Luz', 6, -27.6725, -48.5478);

-- --------------------------------------------------------

--
-- Estrutura da tabela `assento`
--

CREATE TABLE `assento` (
  `id_assento` int NOT NULL,
  `preco_economico` decimal(6,2) NOT NULL,
  `preco_premium` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `assento`
--

INSERT INTO `assento` (`id_assento`, `preco_economico`, `preco_premium`) VALUES
(1, '40.00', '120.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aviao`
--

CREATE TABLE `aviao` (
  `id_aviao` int NOT NULL,
  `modelo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `matricula` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `carga` decimal(10,3) NOT NULL,
  `velocidade` decimal(10,2) DEFAULT NULL,
  `fk_aeroporto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aviao`
--

INSERT INTO `aviao` (`id_aviao`, `modelo`, `matricula`, `carga`, `velocidade`, `fk_aeroporto`) VALUES
(1, 'Boeing 747-8', 'PANFS', '447.000', '1041.00', 3),
(2, 'Airbus A350-1000', 'PAABC', '306.000', '903.00', 1),
(3, 'Boeing 787 Dreamliner', 'PANJE', '126.000', '958.00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id_cadastro` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` char(11) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fk_pessoa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id_cadastro`, `email`, `telefone`, `senha`, `fk_pessoa`) VALUES
(1, 'marcelo@host.com', '11955555555', '345120426285ff8b1d43653a4d078170b4761f75', 1),
(2, 'manoel@host.com', '11922222222', 'bfe54caa6d483cc3887dce9d1b8eb91408f1ea7a', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `id_cidade` int NOT NULL,
  `fk_estado` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `nome_cidade` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`id_cidade`, `fk_estado`, `nome_cidade`) VALUES
(1, '25', 'São Paulo'),
(2, '19', 'Rio de Janeiro'),
(3, '13', 'Belo Horizonte'),
(4, '25', 'Guarulhos'),
(5, '5', 'Salvador'),
(6, '24', 'Florianópolis'),
(7, '21', 'Porto Alegre');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conexao`
--

CREATE TABLE `conexao` (
  `id_conexao` int NOT NULL,
  `fk_conexao1` int NOT NULL,
  `fk_conexao2` int NOT NULL,
  `distancia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id_contato` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `assunto` varchar(75) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`id_contato`, `nome`, `email`, `assunto`, `mensagem`, `data_envio`) VALUES
(1, 'Marcelo Costa', 'marcelo@host.com', 'No céu tem pão?', 'e morreu...', NULL),
(2, 'Marcelo Costa', 'marcelo@host.com', 'Teste', 'testetestetestetestetestetesteteste', NULL),
(3, 'João', 'joao@host.com', 'teste', 'testetesteteste', NULL),
(4, 'Roberto', 'roberto@host.com', 'teste', 'testetesteteste', NULL),
(5, 'Junin', 'junin@host.com', 'teste', 'testetestetesteteste', NULL),
(6, 'Fabim do Pneu', 'fabim@host.com', 'teste', 'testetestetestetesteteste', NULL),
(7, 'teste erro', 'teste@host.com', 'teste erro', 'teste erroteste erroteste erroteste erro', NULL),
(8, 'Silvio', 'silvio@host.com', 'Mahoi', 'olha o aviãozinho', '2023-05-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escala`
--

CREATE TABLE `escala` (
  `id_escala` int NOT NULL,
  `fk_escala1` int NOT NULL,
  `fk_escala2` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `id_estado` int NOT NULL,
  `sigla_estado` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `nome_estado` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`id_estado`, `sigla_estado`, `nome_estado`) VALUES
(1, 'AC', 'Acre'),
(2, 'AL', 'Alagoas'),
(3, 'AP', 'Amapá'),
(4, 'AM', 'Amazonas'),
(5, 'BA', 'Bahia'),
(6, 'CE', 'Ceará'),
(7, 'DF', 'Distrito Federal'),
(8, 'ES', 'Espírito Santo'),
(9, 'GO', 'Goiás'),
(10, 'MA', 'Maranhão'),
(11, 'MT', 'Mato Grosso'),
(12, 'MS', 'Mato Grosso do Sul'),
(13, 'MG', 'Minas Gerais'),
(14, 'PA', 'Pará'),
(15, 'PB', 'Paraíba'),
(16, 'PR', 'Paraná'),
(17, 'PE', 'Pernambuco'),
(18, 'PI', 'Piauí'),
(19, 'RJ', 'Rio de Janeiro'),
(20, 'RN', 'Rio Grande do Norte'),
(21, 'RS', 'Rio Grande do Sul'),
(22, 'RO', 'Rondônia'),
(23, 'RR', 'Roraima'),
(24, 'SC', 'Santa Catarina'),
(25, 'SP', 'São Paulo'),
(26, 'SE', 'Sergipe'),
(27, 'TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_funcionario` int NOT NULL,
  `funcao` enum('admin','comum') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'comum',
  `fk_pessoa` int NOT NULL,
  `fk_cadastro` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `funcao`, `fk_pessoa`, `fk_cadastro`) VALUES
(1, 'admin', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id_pagamento` int NOT NULL,
  `valor_pagamento` decimal(10,2) DEFAULT NULL,
  `tipo` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_pagamento` datetime DEFAULT NULL,
  `fk_cadastro` int NOT NULL,
  `fk_passagem` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `passageiro`
--

CREATE TABLE `passageiro` (
  `id_passageiro` int NOT NULL,
  `fk_pessoa` int NOT NULL,
  `fk_cadastro` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `passagem`
--

CREATE TABLE `passagem` (
  `id_passagem` int NOT NULL,
  `preco_final` decimal(10,2) NOT NULL,
  `status_passagem` enum('paga','não paga','cancelada') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fk_voo` int NOT NULL,
  `fk_passageiro` int NOT NULL,
  `fk_assento` int NOT NULL,
  `fk_pagamento` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_pessoa` int NOT NULL,
  `p_nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `p_sobrenome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_nasc` date NOT NULL,
  `sexo` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `nacionalidade` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cpf` char(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `passaporte` char(11) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `p_nome`, `p_sobrenome`, `endereco`, `data_nasc`, `sexo`, `nacionalidade`, `cpf`, `passaporte`) VALUES
(1, 'Marcelo', 'Costa', 'Rua Juscelino Pinheiro de Sá;Jardim do Édem;Itapecerica da Serra;SP;147;06865030', '1987-01-12', 'h', 'FI', '48200879089', 'AB123456'),
(2, 'Manoel', 'Gomes', 'Avenida João Pessoa; Centro; Balsas; MA; 147; 65800970', '1969-12-02', 'h', 'BR', '26337353048', 'CA123456');

-- --------------------------------------------------------

--
-- Estrutura da tabela `voo`
--

CREATE TABLE `voo` (
  `id_voo` int NOT NULL,
  `origem` int NOT NULL,
  `destino` int NOT NULL,
  `duracao` time NOT NULL,
  `distancia` decimal(10,2) NOT NULL,
  `data_ida` datetime NOT NULL,
  `data_chegada` datetime NOT NULL,
  `aviao` int NOT NULL,
  `fk_assento` int NOT NULL,
  `escala` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `voo`
--

INSERT INTO `voo` (`id_voo`, `origem`, `destino`, `duracao`, `distancia`, `data_ida`, `data_chegada`, `aviao`, `fk_assento`, `escala`) VALUES
(1, 1, 2, '00:00:00', '0.00', '2023-05-11 08:34:00', '2023-05-11 08:34:00', 2, 1, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aeroporto`
--
ALTER TABLE `aeroporto`
  ADD PRIMARY KEY (`id_aeroporto`),
  ADD KEY `fk_cidade` (`fk_cidade`);

--
-- Índices para tabela `assento`
--
ALTER TABLE `assento`
  ADD PRIMARY KEY (`id_assento`);

--
-- Índices para tabela `aviao`
--
ALTER TABLE `aviao`
  ADD PRIMARY KEY (`id_aviao`);

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id_cadastro`),
  ADD KEY `fk_pessoa` (`fk_pessoa`);

--
-- Índices para tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`id_cidade`);

--
-- Índices para tabela `conexao`
--
ALTER TABLE `conexao`
  ADD PRIMARY KEY (`id_conexao`),
  ADD KEY `fk_conexao1` (`fk_conexao1`),
  ADD KEY `fk_conexao2` (`fk_conexao2`);

--
-- Índices para tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id_contato`);

--
-- Índices para tabela `escala`
--
ALTER TABLE `escala`
  ADD PRIMARY KEY (`id_escala`),
  ADD KEY `fk_escala1` (`fk_escala1`),
  ADD KEY `fk_escala2` (`fk_escala2`);

--
-- Índices para tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD KEY `fk_pessoa` (`fk_pessoa`),
  ADD KEY `fk_cadastro` (`fk_cadastro`);

--
-- Índices para tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id_pagamento`),
  ADD KEY `fk_cadastro` (`fk_cadastro`),
  ADD KEY `fk_passagem` (`fk_passagem`);

--
-- Índices para tabela `passageiro`
--
ALTER TABLE `passageiro`
  ADD PRIMARY KEY (`id_passageiro`),
  ADD KEY `fk_pessoa` (`fk_pessoa`),
  ADD KEY `fk_cadastro` (`fk_cadastro`);

--
-- Índices para tabela `passagem`
--
ALTER TABLE `passagem`
  ADD PRIMARY KEY (`id_passagem`),
  ADD KEY `fk_voo` (`fk_voo`),
  ADD KEY `fk_assento` (`fk_assento`),
  ADD KEY `fk_passageiro` (`fk_passageiro`),
  ADD KEY `fk_pagamento` (`fk_pagamento`);

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Índices para tabela `voo`
--
ALTER TABLE `voo`
  ADD PRIMARY KEY (`id_voo`),
  ADD KEY `origem` (`origem`),
  ADD KEY `destino` (`destino`),
  ADD KEY `aviao` (`aviao`),
  ADD KEY `fk_assento` (`fk_assento`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aeroporto`
--
ALTER TABLE `aeroporto`
  MODIFY `id_aeroporto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `assento`
--
ALTER TABLE `assento`
  MODIFY `id_assento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `aviao`
--
ALTER TABLE `aviao`
  MODIFY `id_aviao` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id_cadastro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `id_cidade` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `conexao`
--
ALTER TABLE `conexao`
  MODIFY `id_conexao` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id_contato` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `escala`
--
ALTER TABLE `escala`
  MODIFY `id_escala` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_funcionario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id_pagamento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `passageiro`
--
ALTER TABLE `passageiro`
  MODIFY `id_passageiro` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `passagem`
--
ALTER TABLE `passagem`
  MODIFY `id_passagem` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `voo`
--
ALTER TABLE `voo`
  MODIFY `id_voo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aeroporto`
--
ALTER TABLE `aeroporto`
  ADD CONSTRAINT `aeroporto_ibfk_1` FOREIGN KEY (`fk_cidade`) REFERENCES `cidade` (`id_cidade`);

--
-- Limitadores para a tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `cadastro_ibfk_1` FOREIGN KEY (`fk_pessoa`) REFERENCES `pessoa` (`id_pessoa`);

--
-- Limitadores para a tabela `conexao`
--
ALTER TABLE `conexao`
  ADD CONSTRAINT `conexao_ibfk_1` FOREIGN KEY (`fk_conexao1`) REFERENCES `aeroporto` (`id_aeroporto`),
  ADD CONSTRAINT `conexao_ibfk_2` FOREIGN KEY (`fk_conexao2`) REFERENCES `aeroporto` (`id_aeroporto`);

--
-- Limitadores para a tabela `escala`
--
ALTER TABLE `escala`
  ADD CONSTRAINT `escala_ibfk_1` FOREIGN KEY (`fk_escala1`) REFERENCES `aeroporto` (`id_aeroporto`),
  ADD CONSTRAINT `escala_ibfk_2` FOREIGN KEY (`fk_escala2`) REFERENCES `aeroporto` (`id_aeroporto`);

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`fk_pessoa`) REFERENCES `pessoa` (`id_pessoa`),
  ADD CONSTRAINT `funcionario_ibfk_2` FOREIGN KEY (`fk_cadastro`) REFERENCES `cadastro` (`id_cadastro`);

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`fk_cadastro`) REFERENCES `cadastro` (`id_cadastro`),
  ADD CONSTRAINT `pagamento_ibfk_2` FOREIGN KEY (`fk_passagem`) REFERENCES `passagem` (`id_passagem`);

--
-- Limitadores para a tabela `passageiro`
--
ALTER TABLE `passageiro`
  ADD CONSTRAINT `passageiro_ibfk_1` FOREIGN KEY (`fk_pessoa`) REFERENCES `pessoa` (`id_pessoa`),
  ADD CONSTRAINT `passageiro_ibfk_2` FOREIGN KEY (`fk_cadastro`) REFERENCES `cadastro` (`id_cadastro`);

--
-- Limitadores para a tabela `passagem`
--
ALTER TABLE `passagem`
  ADD CONSTRAINT `passagem_ibfk_1` FOREIGN KEY (`fk_voo`) REFERENCES `voo` (`id_voo`),
  ADD CONSTRAINT `passagem_ibfk_2` FOREIGN KEY (`fk_assento`) REFERENCES `assento` (`id_assento`),
  ADD CONSTRAINT `passagem_ibfk_3` FOREIGN KEY (`fk_passageiro`) REFERENCES `passageiro` (`id_passageiro`),
  ADD CONSTRAINT `passagem_ibfk_4` FOREIGN KEY (`fk_pagamento`) REFERENCES `pagamento` (`id_pagamento`);

--
-- Limitadores para a tabela `voo`
--
ALTER TABLE `voo`
  ADD CONSTRAINT `voo_ibfk_1` FOREIGN KEY (`origem`) REFERENCES `aeroporto` (`id_aeroporto`),
  ADD CONSTRAINT `voo_ibfk_2` FOREIGN KEY (`destino`) REFERENCES `aeroporto` (`id_aeroporto`),
  ADD CONSTRAINT `voo_ibfk_3` FOREIGN KEY (`aviao`) REFERENCES `aviao` (`id_aviao`),
  ADD CONSTRAINT `voo_ibfk_4` FOREIGN KEY (`fk_assento`) REFERENCES `assento` (`id_assento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
