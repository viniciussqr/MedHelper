-- Banco de dados: medhelper
CREATE DATABASE IF NOT EXISTS medhelper DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE medhelper;

-- Estrutura da tabela especializacao
CREATE TABLE IF NOT EXISTS Especializacao (
  Codigo INT(11) NOT NULL PRIMARY KEY,
  Nome VARCHAR(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Estrutura da tabela medicos
CREATE TABLE IF NOT EXISTS Medicos (
  SIAPE VARCHAR(12) NOT NULL PRIMARY KEY,  -- SIAPE como chave primária
  CRM VARCHAR(12) NOT NULL,
  Nome VARCHAR(200) NOT NULL,
  Email VARCHAR(150) NOT NULL,
  Login VARCHAR(15) NOT NULL,
  Senha VARCHAR(10) NOT NULL,
  Telefone VARCHAR(12) NOT NULL,
  Codigo_Especializacao INT(11) NOT NULL,
  FOREIGN KEY (Codigo_Especializacao) REFERENCES Especializacao(Codigo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Estrutura da tabela servidores
CREATE TABLE IF NOT EXISTS Servidores (
  SIAPE VARCHAR(12) NOT NULL PRIMARY KEY,  -- SIAPE como chave primária
  Nome VARCHAR(200) NOT NULL,
  Email VARCHAR(150) NOT NULL,
  Login VARCHAR(15) NOT NULL,
  Senha VARCHAR(10) NOT NULL,
  Telefone VARCHAR(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Estrutura da tabela produtos
CREATE TABLE IF NOT EXISTS Produtos (
  Codigo INT(11) NOT NULL PRIMARY KEY,
  Nome VARCHAR(150) NOT NULL,
  Quantidade_Atual INT(11) NOT NULL,
  Quantidade_Minima INT(11) NOT NULL,
  Quantidade_Ideal INT(11) NOT NULL,
  Tipo_Produto VARCHAR(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Estrutura da tabela atendimentos
CREATE TABLE IF NOT EXISTS Atendimentos (
  Codigo INT(12) NOT NULL PRIMARY KEY,    -- Codigo como chave primária
  Status VARCHAR(12) NOT NULL,
  Prontuario VARCHAR(500) NOT NULL,
  Sintomas VARCHAR(500) NOT NULL,
  Data DATE NOT NULL,
  Hora TIME(5) NOT NULL,
  SIAPE_Medicos VARCHAR(12) NOT NULL,     -- Chave estrangeira para Medicos
  SIAPE_Servidores VARCHAR(12) NOT NULL,  -- Chave estrangeira para Servidores
  
  -- Definindo as chaves estrangeiras
  FOREIGN KEY(SIAPE_Medicos) REFERENCES Medicos(SIAPE),
  FOREIGN KEY(SIAPE_Servidores) REFERENCES Servidores(SIAPE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
