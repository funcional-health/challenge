import express from 'express';
import cors from 'cors';
import expressGraphql from 'express-graphql';
import schema from './schema';
import resolvers from './resolvers';

const app = express();

app.use(
  '/graphql',
  expressGraphql({
    schema,
    rootValue: resolvers,
    graphiql: true,
  }),
);

app.use(cors());

export default app;
