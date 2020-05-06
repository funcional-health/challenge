import request from 'supertest';
import app from '../app';

describe('Transactions - INTEGRATION tests', () => {
  it('should NOT be able to make a invalid income transaction', async () => {
    const response = await request(app)
      .post('/graphql')
      .set('Content-Type', 'application/json')
      .set('Accept', 'application/json')
      .send({
        query:
          'mutation depositar { depositar(conta: 54321, valor:0) { conta saldo }}',
      });

    expect(response.status).toBe(200);
    expect(response.body.errors[0].message).toBe('Valor inválido.');
  });

  it('should NOT be able to make a invalid outcome transaction', async () => {
    const response = await request(app)
      .post('/graphql')
      .set('Content-Type', 'application/json')
      .set('Accept', 'application/json')
      .send({
        query:
          'mutation sacar { sacar(conta: 54321, valor: 10) { conta saldo }}',
      });

    expect(response.status).toBe(200);
    expect(response.body.errors[0].message).toBe('Saldo insuficiente.');
  });

  it('should be able to make a income transaction', async () => {
    const response = await request(app)
      .post('/graphql')
      .set('Content-Type', 'application/json')
      .set('Accept', 'application/json')
      .send({
        query:
          'mutation depositar { depositar(conta: 54321, valor:10) { conta saldo }}',
      });

    expect(response.status).toBe(200);

    expect(response.body).toEqual(
      expect.objectContaining({
        data: {
          depositar: {
            conta: 54321,
            saldo: 10,
          },
        },
      }),
    );
  });

  it('should be able to make a outcome transaction', async () => {
    const response = await request(app)
      .post('/graphql')
      .set('Content-Type', 'application/json')
      .set('Accept', 'application/json')
      .send({
        query: 'mutation sacar { sacar(conta: 54321, valor:8) { conta saldo }}',
      });

    expect(response.status).toBe(200);

    expect(response.body).toEqual(
      expect.objectContaining({
        data: {
          sacar: {
            conta: 54321,
            saldo: 2,
          },
        },
      }),
    );
  });

  it('should be able to get balance after transactions', async () => {
    const response = await request(app)
      .post('/graphql')
      .set('Content-Type', 'application/json')
      .set('Accept', 'application/json')
      .send({
        query: 'query saldo { saldo(conta: 54321) { saldo }}',
      });

    expect(response.status).toBe(200);

    expect(response.body).toEqual(
      expect.objectContaining({
        data: {
          saldo: {
            saldo: 2,
          },
        },
      }),
    );
  });
});
