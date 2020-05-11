# Exame de Programador C\#

**Objetivo**: desenvolver uma API GraphQL em C# + .NET Core simulando um caixa eletrônico.

Nesta simulação considere que não há necessidade de autenticação.

## História

SENDO EU um correntista do banco<br>
QUERO poder movimentar a minha conta corrente<br>
PARA poder saldar as minhas dívidas

## Cenários

DADO QUE eu consuma a API GraphQL<br>
QUANDO eu chamar a mutation `sacar` informando o número da conta e um valor válido<br>
ENTÃO o saldo da minha conta no banco de dados diminuirá de acordo<br>
E a mutation retornará o saldo atualizado.

DADO QUE eu consuma a API GraphQL<br>
QUANDO eu chamar a mutation `sacar` informando o número da conta e um valor maior do que o meu saldo<br>
ENTÃO a mutation me retornará um erro do GraphQL informando que eu não tenho saldo suficiente

DADO QUE eu consuma a API GraphQL<br>
QUANDO eu chamar a mutation `depositar` informando o número da conta e um valor válido<br>
ENTÃO a mutation atualizará o saldo da conta no banco de dados<br>
E a mutation retornará o saldo atualizado.

DADO QUE eu consuma a API GraphQL<br>
QUANDO eu chamar a query `saldo` informando o número da conta<br>
ENTÃO a query retornará o saldo atualizado.

**Exemplo 1**

Requisição:

```
mutation {
  sacar(conta: 54321, valor: 140) {
    conta
    saldo
  }
}
```

Resposta:

```
{
  "data": {
    "sacar": {
      "conta": 54321,
      "saldo": 20
    }
  }
}
```

**Exemplo 2**

Requisição

```
mutation {
  sacar(conta: 54321, valor: 30000) {
    conta
    saldo
  }
}
```

Exemplo de resposta (não precisa ser idêntico):

```
{
  "errors": [
    {
      "message": "Saldo insuficiente.",
      "extensions": {
        "category": "graphql"
      },
      "locations": [
        {
          "line": 9,
          "column": 5
        }
      ]
    }
  ]
}
}
```

**Exemplo 3**

Requisição:

```
mutation {
  depositar(conta: 54321, valor: 200) {
    conta
    saldo
  }
}
```

Resposta:

```
{
  "data": {
    "depositar": {
      "conta": 54321,
      "saldo": 220
    }
  }
}
```

**Exemplo 4**

Requisição:

```
query {
  saldo(conta: 54321)
}
```

Resposta:

```
{
  "data": {
    "saldo": 220
  }
}
```

## Requisitos Obrigatórios

* A API deve ser desenvolvida em C# com .NET Core
* A API deve ser GraphQL
* O projeto deve ser entregue em um repositório do GitHub
* O projeto deve ter testes unitários com PHPUnit com cobertura de testes >= a 85%

## Dicas

* Você poderá optar por utilizar um banco de dados relacional ou não relacional. Sugerimos que você utilize o Postgres, MySQL ou algum NoSQL como o Mongo;
* Você também poderá desenvolver seu projeto utilizando cloud services. Se você optar por essa solução, não se esqueça de disponibilizar a URL! 
* Colocar no repositório os scripts do Docker
