## Setup Rápido com Docker

Para rodar o projeto rapidamente com Docker (PHP 8.4, MySQL, Redis, Nginx):

```bash
# Clone o repositório
git clone https://github.com/rogerarruda/roger-backend-challenge
cd roger-backend-challenge

# Execute o script de setup automático
./setup.sh
```

A aplicação estará disponível em: http://localhost:8000

Para rodar os testes:
```bash
docker-compose exec app php artisan test
```

📚 **Documentação completa do Docker**: [DOCKER_SETUP.md](DOCKER_SETUP.md)

## 📋 Documentação da API

### API Documentation
Documentação completa dos endpoints da API de faixas musicais: [API_DOCUMENTATION.md](API_DOCUMENTATION.md)

### Postman Collection
Coleção do Postman pronta para importar com todos os endpoints e exemplos: [postman_collection.json](postman_collection.json)

**Como importar no Postman:**
1. Abra o Postman
2. Clique em "Import" 
3. Selecione o arquivo `postman_collection.json`
4. A coleção "Roger Backend Challenge - Tracks API" será importada com todos os endpoints

**Endpoints disponíveis:**
- `GET /api/tracks` - Listar faixas com filtros, busca, ordenação e paginação
- `GET /api/tracks/{id}` - Obter detalhes de uma faixa específica


## O que foi feito

### Estrutura API e projeto

- API RESTful completa com endpoints para listagem, detalhes e busca de faixas
- Filtros avançados (busca por texto, artista, disponibilidade no Brasil)
- Paginação e ordenação dinâmica por diferentes campos
- Relacionamentos Eloquent estruturados (Track/Artist/Album)
- Accessors para formatação automática de dados (duração, datas)
- Resources para formatação consistente (TrackResource, ArtistResource, AlbumResource)
- Validação com FormRequest
- Importação das informações de faixas musicais do Spotify, somente quando encontradas com base no ISRC
- Service Pattern para integração com Spotify Web API

### Documentação e Testes
- Documentação da API completa
- Coleção Postman com todos os endpoints e exemplos
- Testes automatizados para validação e casos de erro
- Setup Docker para ambiente de desenvolvimento

### Próximos passos

- Importação via CSV com Jobs assíncronos para maior flexibilidade
- Cache Redis para otimização de consultas frequentes
- Rate limiting para proteção da API
- Monitoramento e métricas de desempenho
- Filtros adicionais conforme necessidade do negócio
- Download das imagens de capa das faixas/álbum para serviço local

---

## Início

Bem vindo ao mundo da música!

Atualmente temos a necessidade de consumir os dados de faixas musicais através do código ISRC, que é uma das coisas mais importantes na indústria fonográfica.

Segundo [Abramus](https://www.abramus.org.br/musica/isrc/), ISRC (International Standard Recording Code ou Código de Gravação Padrão Internacional) é um padrão internacional de código para identificar de forma única as gravações (faixas).

Ele funciona como um código de barras da faixa.


## Problema

Durante o fechamento de contrato com um produtor, foram informados 10 ISRC's que não constam em nossas bases de dados, que seguem abaixo:

* US7VG1846811
* US7QQ1846811
* BRC310600002
* BR1SP1200071
* BR1SP1200070
* BR1SP1500002
* BXKZM1900338
* BXKZM1900345
* QZNJX2081700
* QZNJX2078148

Precisamos obter e exibir os seguintes dados:

* Thumb do álbum
* Data de lançamento
* Título da faixa
* Lista dos artistas da faixa
* Duração da faixa em minutos e segundos (mm:ss)
* Player com prévia do áudio
* Link para a página da faixa no Spotify
* Sinalização dizendo se a faixa está ou não disponível no Brasil (BR)

Por decisão técnica, temos a necessidade de guardar estas informações em um banco de dados. Para isso, fique livre para criar a estrutura necessária para guardar as informações que achar pertinente das faixas.

Uma vez armazenados os dados, precisamos exibí-los através de uma webpage pública, ordenados por título da faixa de forma alfabética.


## Requisitos

* Faça um fork deste repositório e abra um PR quando estiver finalizado.
* O backend deve ser feito no framework Laravel 7.0 ou superior.
* O banco de dados deve ser MySQL.
* A página deve ser responsiva para atender todos os tipos de dispositivos.
* Use a API do Spotify: [https://developer.spotify.com/](https://developer.spotify.com/) para coletar os dados das faixas.


## Diferencial

* Desenvolver o frontend no Angular 8 ou superior.
* Desenvolver testes unitários e de integração.


## O que será avaliado

* Fidelidade às instruções.
* Padrões de projeto.
* Clean Code e boas práticas.
* Boas práticas de versionamento.


## Perfil que buscamos

* Comunicativo
* Autodidata
* Automotivado
* Curioso
* Gostar de trabalhar em equipe
* Compromissado
