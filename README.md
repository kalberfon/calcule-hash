#### Requisitos
 - `Docker` instalado
 - `docker-compose` instalado


### Instruções para abrir projeto
 
 - Rodar o comando `docker-compose up -d --build` 
 - Instalar dependencias, utilizando o composer `docker-compose exec app composer install`
 - Criar o banco de dados `docker-compose exec app php artisan testdb:make` ira criar a migrar.
 - Copiar o .env de exemplo para o que a aplicação ira utilizar `docker-compose exec app cp .env.example .env` 
## Instruções para consultas

#### Comando

 - Rode o comando com a assinatura `docker-compose exec app php artisan nofaro:test NofaroKey --request=100`
 Exemplo: 
     ````bash
    docker-compose exec app php artisan hash:calcule 'meu lindo teste' --request=12 

#### Rota de consulta

**Collection do postman com as rotas [Nofaro Collection](./calcule-hash.collection.json)**

 - `'GET' /api/hash`  retorna todos os hash criados com um paginador **(Filtros e exemplos na collection)**
 - `'POST' /api/hash` Solicita um novo hash **(Filtros e exemplos na collection)**
