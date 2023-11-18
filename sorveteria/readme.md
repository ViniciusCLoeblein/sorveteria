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
 
ALTER TABLE ItemVenda ADD CONSTRAINT fk_codProduto
    FOREIGN KEY (codProduto)
    REFERENCES Produto (codProduto)
    ON DELETE RESTRICT;
 
ALTER TABLE ItemVenda ADD CONSTRAINT fk_vendaSeq
    FOREIGN KEY (vendaSeq)
    REFERENCES Venda (seq)
    ON DELETE SET NULL;