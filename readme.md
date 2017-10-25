PROCEDIMENTOS

EXECUTAR ANTES DA APLICAÇÃO CLIENTE

1- Criação do Database (Mysql)
  - executar DUMP de storage/dumps/create_database.sql

2 - Alterar parametros no .env para o Banco
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=jwt_test
	DB_USERNAME=root
	DB_PASSWORD=testes

3 - Configurar HOST
	- APP_URL=http://moving-test.local (No meu caso) SERA USADO NA OUTRA APLICAÇÃO

4 - RODAR migrations e seeds
      - executar na raiz
	- php artisan migrate
	- php artisan db:seed


DESCRIÇÃO:
	esta aplicação fornece autenticação JWT

RECURSOS:
	Listagem de Usuarios
	Edição de usuarios
	Inserção de usuarios
	Exclusão de usuarios
