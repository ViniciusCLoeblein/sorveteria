## Banco 

CREATE TABLE Produto (
    codProduto INTEGER PRIMARY KEY,
    desProduto VARCHAR(50),
    valor NUMERIC(8,2),
    estoque INTEGER,
    estoqueMinimo INTEGER,
    codFornecedor INTEGER,
    codCategoria INTEGER
);

CREATE TABLE Fornecedor (
    codFornecedor INTEGER PRIMARY KEY,
    desFornecedor VARCHAR(50),
    cnpj VARCHAR(16),
    numContato VARCHAR(20),
    estado VARCHAR(2)
);

CREATE TABLE Categoria (
    codCategoria INTEGER PRIMARY KEY,
    desCategoria VARCHAR(50)
);

CREATE TABLE Venda (
    seq INTEGER PRIMARY KEY,
    numCupom INTEGER,
    dtaVenda DATE,
    valorTotal NUMERIC(8,2),
    codUsuario INTEGER
);

CREATE TABLE Usuario (
    codUsuario INTEGER PRIMARY KEY,
    nome VARCHAR(50),
    sobrenome VARCHAR(100),
    CPF VARCHAR(11),
    dtaNascimento DATE,
    indAdm INTEGER,
    senha VARCHAR(30)
);

CREATE TABLE ItemVenda (
    codProduto INTEGER,
    vendaSeq INTEGER,
    qtdProduto INTEGER
);
 
ALTER TABLE Produto ADD CONSTRAINT fk_codFornecedor
    FOREIGN KEY (codFornecedor)
    REFERENCES Fornecedor (codFornecedor)
    ON DELETE RESTRICT;
 
ALTER TABLE Produto ADD CONSTRAINT fk_codCategoria
    FOREIGN KEY (codCategoria)
    REFERENCES Categoria (codCategoria)
    ON DELETE RESTRICT;
 
ALTER TABLE Venda ADD CONSTRAINT fk_codUsuario
    FOREIGN KEY (codUsuario)
    REFERENCES Usuario (codUsuario)
    ON DELETE CASCADE;

ALTER TABLE ItemVenda ADD CONSTRAINT PK_ItemVenda 
    PRIMARY KEY (codProduto, vendaSeq);
 
ALTER TABLE ItemVenda ADD CONSTRAINT fk_codProduto
    FOREIGN KEY (codProduto)
    REFERENCES Produto (codProduto);
 
ALTER TABLE ItemVenda ADD CONSTRAINT fk_vendaSeq
    FOREIGN KEY (vendaSeq)
    REFERENCES Venda (seq);



--Inserts


-- Inserir dados na tabela Categoria
INSERT INTO Categoria (codCategoria, desCategoria)
VALUES
    (1, 'Sorvetes'),
    (2, 'Coberturas'),
    (3, 'Utensílios');

-- Inserir dados na tabela Fornecedor
INSERT INTO Fornecedor (codFornecedor, desFornecedor, cnpj, numContato, estado)
VALUES
    (1, 'Fornecedor Frutas Geladas', '12345678901234', '(51) 98765-4321', 'RS'),
    (2, 'Chocolate & Cia', '98765432109876', '(54) 12345-6789', 'RS'),
    (3, 'Especialidades Geladas', '11122233344455', '(55) 67890-1234', 'RS');

-- Inserir dados na tabela Produto
INSERT INTO Produto (codProduto, desProduto, valor, estoque, estoqueMinimo, codFornecedor, codCategoria)
VALUES
    (103, 'Sorvete de Chocolate', 5.99, 80, 15, 2, 1),
    (104, 'Calda de Chocolate', 3.50, 50, 10, 2, 2),
    (105, 'Cones para Sorvete (Pacote com 50)', 12.99, 30, 5, 3, 3),
    (106, 'Granulado Colorido', 2.99, 80, 15, 2, 2);

-- Inserir dados na tabela Usuario
INSERT INTO Usuario (codUsuario, nome, sobrenome, CPF, dtaNascimento, indAdm, senha)
VALUES
    (1, 'Flavia', 'Roseane', '12197755412', '1990-05-15', 1, 'senha123'),
    (2, 'Vinicius', 'do Carmo', '05253464069', '1988-12-10', 0, 'senha123'),
    (3, 'Felipe', 'Oliveira', '11122233344', '1995-08-22', 0, 'senha123');
