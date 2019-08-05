import { gql } from "apollo-server-express";

export const typeDefs = gql`
	type Produto{
		id: String!
		nome: String!
		industria: String!
		quantidade: Int!
		preco: Float!
	}

	type Query{
		createProduto(nome: String!,industria: String!,quantidade: Int!, preco: Float!): Produto!
		allProdutos: [Produto!]!
		produtoIndustria(industria:String!): [Produto!]!
		produtoRemover(nome: String!, industria: String!): String!
		produtoAtualizar(nome: String!,industria: String!,quantidade: Int!, preco: Float!): String!
	}
	`;