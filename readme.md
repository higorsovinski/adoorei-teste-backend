# Teste Adoorei

## Instalação
> Após clonar o projeto e instalar o docker, acesse o diretório do projeto (pelo terminal, prompt) e execute o comando:
```
docker-compose up --build
```

> Quando a imagem estiver rodando no docker, acesse o terminal de setup-php e execute os seguinte comandos para atualizar o banco:
```
php artisan migrate --seed
php artisan db:seed --class=ProductSeeder
php artisan db:seed --class=SaleSeeder
```

> Pronto, agora é só seguir a documentação no postman:

[Link Documentação](https://www.postman.com/higorsovinski/workspace/testes/documentation/25334332-aee883e3-c947-4c63-acd3-24d63e2a9470)