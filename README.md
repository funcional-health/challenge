## Documentação

- Após o clone do repositório, é preciso rodar o comando: 'composer-install' para instalar as dependencias do projeto.
- Eu utilizei o mysql para o desafio, então é necessário criar uma base do mysql antes de rodar as migrações.
- O nome da base pode ser o mesmo que eu usei, que foi: crudprodutos. Feito isso, é necessário configurar tambem o mesmo nome no .env.
- Após isso é necessário rodar o comando: 'php artisan migrate' para criar as tabelas.
- Após as tabelas criadas é necessário rodar o comando: 'php artisan db:seed' para popular as tabelas com dados fake.
- Após realizar todos os passos acima, é necessário rodar o comando: 'php artisan serve'.

## Como Testar

- A api pode ser com qualquer ferramenta que realiza requisições, minha sugestão é que use o postman.
- Utilizei na api os 4 verbos http onde podem ser facilmente configurado no postman.
 
## Verbos

- Get: http://localhost:8000/api/products

- Get: http://localhost:8000/api/products/1

- Post: http://localhost:8000/api/products
    {
        "name": "omnis",
        "industry": "Voluptas nisi velit commodi.",
        "price": "15.00",
        "quantity": "52"
    }

- Put: http://localhost:8000/api/products/1
    {
        "name": "omnis",
        "industry": "Voluptas nisi velit commodi.",
        "price": "15.00",
        "quantity": "52"
    }

- Delete: http://localhost:8000/api/products/1