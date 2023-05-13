-- OBSERVAÇÕES:
--
-- Não alterar o nome do banco de dados;
-- NUNCA deixe de avisar, caso altere alguma coisa no bd ou acrescente;
-- Lembre que os passageiros podem ser bebês ou crianças e tais podem ou não ter algumas informações como NULL;
-- ;

CREATE DATABASE skywaysbdd;

USE skywaysbdd;

CREATE TABLE voo (
	id_voo INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	origem INTEGER NOT NULL,
	destino INTEGER NOT NULL,
	duracao TIME NOT NULL,
	distancia DECIMAL(10,2) NOT NULL,
	data_ida DATETIME NOT NULL,
	data_chegada DATETIME NOT NULL,
	aviao INTEGER NOT NULL,
	fk_assento INTEGER NOT NULL,
	escala INTEGER NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE estado (
	id_estado INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	sigla_estado CHAR(2) NOT NULL,
	nome_estado VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

insert into estado values
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

CREATE TABLE cidade (
	id_cidade INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	fk_estado CHAR(2) NOT NULL,
	nome_cidade VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

insert into cidade values
(default, 25, 'São Paulo'),
(default, 19, 'Rio de Janeiro'),
(default, 13, 'Belo Horizonte'),
(default, 25, 'Guarulhos');

CREATE TABLE aeroporto (
	id_aeroporto INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	sigla CHAR(3) NOT NULL,
	nome VARCHAR(80) NOT NULL,
	fk_cidade INTEGER NOT NULL,
	latitude float NOT NULL,
	longitude float NOT NULL,
	FOREIGN KEY(fk_cidade) REFERENCES cidade (id_cidade)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE conexao (
	id_conexao INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	fk_conexao1 INTEGER NOT NULL,
	fk_conexao2 INTEGER NOT NULL,
	-- duracao TIME NOT NULL,
	distancia DECIMAL(10,2) NOT NULL,
	-- data_ida DATETIME NOT NULL,
	-- data_chegada DATETIME NOT NULL,
	FOREIGN KEY(fk_conexao1) REFERENCES aeroporto (id_aeroporto),
	FOREIGN KEY(fk_conexao2) REFERENCES aeroporto (id_aeroporto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE escala (
	id_escala INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	fk_escala1 INTEGER NOT NULL,
	fk_escala2 INTEGER NOT NULL,
	-- duracao TIME NOT NULL,
	-- distancia DECIMAL(10,2) NOT NULL,
	-- data_ida DATETIME NOT NULL,
	-- data_chegada DATETIME NOT NULL,
	FOREIGN KEY(fk_escala1) REFERENCES aeroporto (id_aeroporto),
	FOREIGN KEY(fk_escala2) REFERENCES aeroporto (id_aeroporto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE aviao (
	id_aviao INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	modelo VARCHAR(50) NOT NULL,
	matricula CHAR(5) NOT NULL,
	carga DECIMAL(10,2) NOT NULL,
	velocidade DECIMAL(10,2),
	fk_aeroporto INTEGER NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE assento (
	id_assento INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	-- tipo CHAR(1) NOT NULL,
	preco_economico DECIMAL(6,2) NOT NULL,
	preco_premium DECIMAL(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE cadastro (
	id_cadastro INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	email VARCHAR(100) NOT NULL,
	telefone CHAR(11) NOT NULL,
	senha VARCHAR(50) NOT NULL,
	fk_pessoa INTEGER NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO cadastro VALUES
(default, 'v@gmail.com', '11976146999', 'senha', 1);

CREATE TABLE passagem (
	id_passagem INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	preco_final DECIMAL(10,2) NOT NULL,
	status_passagem ENUM('paga', 'não paga', 'cancelada'), -- OBS: Certifique de que seja um desses 3
	local_assento CHAR(3) NOT NULL,
	fk_voo INTEGER NOT NULL,
	fk_passageiro INTEGER NOT NULL,
	-- fk_assento INTEGER NOT NULL,
	fk_pagamento INTEGER NOT NULL,
	FOREIGN KEY(fk_voo) REFERENCES voo (id_voo)
	-- FOREIGN KEY(fk_assento) REFERENCES assento (id_assento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO PASSAGEM VALUES 
(default, 250, 'não paga', 'B2', 3, 1, 1);

CREATE TABLE pagamento (
	id_pagamento INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	valor_pagamento DECIMAL(10,2) NOT NULL,
	tipo CHAR(1),
	data_pagamento DATETIME,
	fk_cadastro INTEGER NOT NULL,
	-- fk_passagem INTEGER NOT NULL,
	FOREIGN KEY(fk_cadastro) REFERENCES cadastro (id_cadastro)
	-- FOREIGN KEY(fk_passagem) REFERENCES passagem (id_passagem)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE pessoa (
	id_pessoa INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	p_nome VARCHAR(50) NOT NULL,
	p_sobrenome VARCHAR(100) NOT NULL,
	data_nasc DATE NOT NULL,
	sexo CHAR(1) NOT NULL,
	cpf CHAR(11) NULL,
	nacionalidade VARCHAR(3) NULL,
	passaporte CHAR(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- INSERT INTO pessoa VALUES
-- (default, 'Venan', 'Oliveira', '2005-05-04', 'M', 'Bra', '13665903688', 'bb123456');

CREATE TABLE funcionario (
	id_funcionario INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
   	funcao ENUM('admin', 'comum') NOT NULL DEFAULT 'comum',
    fk_pessoa INTEGER NOT NULL,
	fk_cadastro INTEGER NOT NULL,
    FOREIGN KEY(fk_pessoa) REFERENCES pessoa (id_pessoa),
	FOREIGN KEY(fk_cadastro) REFERENCES cadastro (id_cadastro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE voo ADD FOREIGN KEY(origem) REFERENCES aeroporto (id_aeroporto);
ALTER TABLE voo ADD FOREIGN KEY(destino) REFERENCES aeroporto (id_aeroporto);
ALTER TABLE voo ADD FOREIGN KEY(aviao) REFERENCES aviao (id_aviao);
ALTER TABLE voo ADD FOREIGN KEY(fk_assento) REFERENCES assento (id_assento);
ALTER TABLE cadastro ADD FOREIGN KEY(fk_pessoa) REFERENCES pessoa (id_pessoa);
ALTER TABLE passagem ADD FOREIGN KEY(fk_passageiro) REFERENCES passageiro (id_passageiro);
ALTER TABLE passagem ADD FOREIGN KEY(fk_pagamento) REFERENCES pagamento (id_pagamento);
ALTER TABLE passagem ADD FOREIGN KEY(fk_passageiro) REFERENCES pessoa (id_pessoa);
