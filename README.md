# symf-rest-docker

REST API с авторизацией на базе OAuth
сущности разделены на docker контейнеры

Порядок действий:
1) поднять docker контэйнеры
2) composer install
3) создаем базу php bin/console doctrine:database:create --if-not-exists 
4) накатываем миграции php bin/console doctrine:migrations:migrate
5) создаем юзера bin/console fos:user:create test_user
5) создаем клиента POST JSON http://127.0.0.1:8080/createClient {
		"grant-type": "password",
		"redirect-uri": "test.uri"
	}
  получаем в ответ client_id + client_secret
6) получаем токен POST BODY http://127.0.0.1:8080/oauth/v2/token {
    "grant-type": "password",
    "redirect-uri": "test.uri",
    "username": "test_user",
    "password": "test"
    "client_id": "xxx",
    "client_secret": "xxx"
  }
  Ответ в виде: {"access_token":"NWRkNGEyZjY3NTBiNGM4MThiYjRmZTcyNTgwNTFkNzgzY2UyOGJmZGJjNTUwNjM4ZjYyODMzNjc1ZjhmZjlkMg","expires_in":86400,"token_type":"bearer","scope":null,"refresh_token":"MDRjNGE4ZTNhMDc0MTJiZDI5OGFmODdlN2Q2ZTU1NGFhYzY5MGNmYzY0ZWRjNzY3MTJlNWUxNzhmNjUzNGUwZg"}
7) Получаем/Создаем/Редактируем категории по путям:
    - GET /api/categories без авторизации
    - PUT /api/category JSON тело вида {"name": "xxx", "state": 1} + HEADER: Authorization: Bearer {TOKEN}
    - POST /api/category JSON тело вида {"name": "xxx", "state": 1} + HEADER: Authorization: Bearer {TOKEN}
