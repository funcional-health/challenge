# Desafio Funcional Health

O desafio foi desenvolvimento em typescript e nodejs, usando melhores práticas de desenvolvimento [SOLID](https://medium.com/joaorobertopb/o-que-%C3%A9-solid-o-guia-completo-para-voc%C3%AA-entender-os-5-princ%C3%ADpios-da-poo-2b937b3fc530) e [Clean Code](https://medium.com/joaorobertopb/2-clean-code-boas-pr%C3%A1ticas-para-escrever-c%C3%B3digos-impec%C3%A1veis-361997b3c8b5).

### Instalação:
A instalação depende dos pacotes [docker-compose](https://docs.docker.com/compose/install/) e [yarn](https://classic.yarnpkg.com/en/docs/install/#debian-stable) instalados na máquina.
```sh
$ git clone https://github.com/tiagomaradei/funcional-health.git
$ cd funcional-health
$ yarn
$ sudo docker-compose up --build -d
```
Após instalação, abrir no navegador: http://localhost:4444/graphql

### Tests
O Projeto contém testes unitários e testes de integração, para rodar os testes só executar o comando abaixo dentro da pasta raiz do projeto:
```sh
yarn test
```
