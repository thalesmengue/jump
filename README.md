# Teste de Back End

## Descrição
Criar uma API Rest que possua um método de criação e um método de listagem com filtros e paginação.

## Como rodar o projeto
```bash
# clone o projeto
$ git clone git@github.com:thalesmengue/greenpay.git

# instale as dependências
$ composer install

# crie o arquivo .env
$ cp .env.example .env

# setar as variáveis de ambiente no .env

# gerar uma nova chave da aplicação
$ php artisan key:generate

# migre as tabelas
$ php artisan migrate

# rode os seeder
$ php artisan db:seed

# rode a aplicação
$ php artisan serve
```

## Rotas
| Método HTTP | Endpoint                                   | Descrição                                                                                                                                                                |
|-------------|--------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| POST        | `/api/service-orders`                      | Rota usada para criar uma ordem de serviço                                                                                                                               |
| GET         | `/api/service-orders`                      | Retorna as ordens de serviço cadastradas, com paginação                                                                                                                  |
| GET         | `/api/service-orders/{plate}/{pagination}` | Retorna as ordens de serviço cadastradas, podendo ser filtrada pela placa do veículo, e também, podendo ser setada a paginação que deseja, caso não setada, o valor é 5. |


## Exemplos de requisições
Request esperado
```json
{
    "user_id": 1,
    "vehiclePlate": "3244GHS",
    "entryDateTime": "2022-10-10T15:03:02",
    "exitDateTime": "2022-10-10T15:03:02",
    "priceType": "money",
    "price": 150.00
}
```

Response esperada
```json
{
    "id": 2,
    "user_id": 8,
    "vehiclePlate": "DEF5678",
    "entryDateTime": "2023-01-18 13:08:25",
    "exitDateTime": "2022-11-03 08:11:03",
    "priceType": "money",
    "price": "254.62",
    "created_at": "2023-05-24T01:22:42.000000Z",
    "updated_at": "2023-05-24T01:22:42.000000Z",
    "user": {
      "name": "Mrs. Rowena Adams"
    }
}
```


## Testes
Foram realizados testes para cobrir os possíveis cenários da aplicação.
Caso os testes sejam rodados, e após tente inserir dados manualmente pelo postman/insomnia será necessário rodar novamente
o comando ```php artisan migrate```, pois, os testes possuem a trait ```DatabaseMigrations``` para garantir
que quando cada teste for rodar, o banco de dados esteja vazio.

Para rodar os testes digite:
```bash
 php artisan test
```

## Tecnologias utilizadas
- [Laravel 10](https://laravel.com/docs/10.x/installation)
- [PHP 8.1](https://www.php.net/)
