# .PlayaSong API

## Objetivo:

Recebe código ISRC, busca dados da música na API do Spotify e as salva no banco de dados.

## Tecnologias:

### Node
[Instalação](https://nodejs.org/en/)

### Express
    npm install express

### Nodemon
    npm install nodemon

### Jest
    npm install ts-jest -D

### Typescript
    npm install -D typescript ts-node

### MySQL
    npm install mysql2

## Rodar o projeto

### Banco dependente
O projeto faz uso de uma tabela, este script pode ser usado para cria-la:

    CREATE TABLE songs (
    id int primary key auto_increment,
    name varchar(256),
    ISRC varchar(256) unique,
    thumbFile varchar(256),
    thumbFileIcon varchar(256),
    previewFile varchar(256),
    spotifyUrl varchar(256),
    isAvaibleAtCountry boolean,
    debutDate DATE,
    milliseconds varchar(122),
    artists varchar(256)
    );

### Configurar .env
Na raíz do projeto, configure um .env com os parâmetros de conexões externas da aplicação

### yarn dev
No terminal, abra o projeto e rode o comando:
###
    yarn dev