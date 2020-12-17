# TESTE CUCO HEALTH
---

## Rodando a Aplicação (Com Docker)
---

Necessário ter o `docker` e o `docker-compose` instalados.
- Copiar o arquivo `.env.example` para `.env`.
- Caso queria trocar as variáveis no `.env` lembre-se de trocar tanto na sessão do Docker quanto da aplicação.
- Subir os containers Docker com `docker-compose up -d`
- O Docker do projeto possui 3 containers (`PHP 7.4-FPM`, `MySQL 5`, `Nginx 1.16`) e dentro do container de `PHP` tem o `Composer` instalado.
- Instalar os pacotes da aplicação com `docker exec -it cuco-api-php-fpm composer install` (Caso queira instalar os pacotes sem utilizar o Composer do Docker é possível usar (Caso o tenha instalado) o que se encontra em seu computador, basta digitar `composer install`).
- Gerar a chave da aplicação com `docker exec -it cuco-api-php-fpm php artisan key:generate` (Caso não queira gerar a chave na aplicação no Docker também é possível (Caso possua uma versão do `PHP >= 7.3`), basta digitar `php artisan key:generate`).
- Popular e criar o banco de dados com o Laravel, para isso basta digitar `docker exec -it cuco-api-php-fpm php artisan migrate:fresh --seed` (Caso não queira utilizar o Laravel para criar e popular o banco de dados, existe um dump de uma base de dados em `database/dump.sql`, basta importar esse arquivo para seu SGBD e executar o script).
- Feito esses passos, caso não tenha alterado nenhuma variável no `.env`, sua aplicação está servida em `localhost:8000`.

### Rodando a Aplicação (Sem Docker)
---

Necessário `PHP >= 7.3` e `MySQL >= 5.7`.
- Copiar o arquivo `.env.example` para `.env`.
- Lembre-se de trocar as variáveis no `.env` correspondentes ao banco de dados e fazer o devido apontamento para o mesmo.
- Instalar os pacotes da aplicação com `composer install`.
- Gerar a chave da aplicação com `php artisan key:generate`.
- Popular e criar o banco de dados com o Laravel, para isso, basta digitar `php artisan migrate:fresh --seed` (Caso não queira utilizar o Laravel para criar e popular o banco de dados, existe um dump de uma base de dados em `database/dump.sql`, basta importar esse arquivo para seu SGBD e executar o script).
- Após essas configurações, basta digitar `php artisan serve` para servir a aplicação.
- - Feito esses passos, caso não tenha alterado a porta na hora de servir a aplicação, sua aplicação está servida em `localhost:8000`.

## Link da Documentaçao da API
---

Feito com Collection do Postman.
- https://www.postman.com/collections/0cf696213b89952f5aee
