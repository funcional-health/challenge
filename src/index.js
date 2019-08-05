import { ApolloServer, gql } from 'apollo-server-express';
import express from 'express';
import mongoose from 'mongoose';
import { resolvers } from './resolvers';
import { typeDefs } from './typeDefs';

const app = express();

const startServer = async () => {
	const server = new ApolloServer({
	  typeDefs,
	  resolvers,
	});

	server.applyMiddleware({ app }); 

	await mongoose.connect('mongodb://localhost:27017/ProdutosHospitalares', {useNewUrlParser: true});

	app.listen({ port: 5000 }, () =>
	  console.log(`Server ready at http://localhost:4000${server.graphqlPath}`)
	)
}

startServer();