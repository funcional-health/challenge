import { buildSchema } from 'graphql';

const schema = buildSchema(`
  type Saldo {
    saldo: Int!
  }
  type Transaction {
    conta: Int!
    saldo: Int!
  }
  type Query {
    saldo(conta: Int!): Saldo
  }
  type Mutation {
    depositar(conta: Int!, valor: Int!): Transaction
    sacar(conta: Int!, valor: Int!): Transaction
  }
`);

export default schema;
