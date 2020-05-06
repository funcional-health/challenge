import { Transaction } from '../contracts';
import getBalance from '../utils';
import IncomeService from '../services/IncomeService';
import OutcomeService from '../services/OutcomeService';

let transactions: Array<Transaction> = [];

describe('Transactions - UNIT tests', () => {
  beforeEach(async () => {
    transactions = [];
  });

  it('should be able to make a income transaction', async () => {
    const income = new IncomeService();
    const balance = income.execute(54321, 10, transactions);
    expect(balance).toBe(10);

    expect(transactions).toHaveLength(1);
    expect(transactions).toEqual(
      expect.arrayContaining([
        expect.objectContaining({
          type: 'income',
          account: 54321,
          value: 10,
        }),
      ]),
    );
  });

  it('should be able to make a outcome transaction', async () => {
    const income = new IncomeService();
    const balance = income.execute(54321, 10, transactions);
    expect(balance).toBe(10);

    const outcome = new OutcomeService();
    const balance2 = outcome.execute(54321, 8, transactions);
    expect(balance2).toBe(2);

    expect(transactions).toHaveLength(2);
    expect(transactions).toEqual(
      expect.arrayContaining([
        expect.objectContaining({
          type: 'outcome',
          account: 54321,
          value: 8,
        }),
      ]),
    );
  });

  it('should be able to get balance after transactions', async () => {
    const balance = getBalance(54321, transactions);
    expect(balance).toBe(0);

    const income = new IncomeService();
    const balance2 = income.execute(54321, 10, transactions);
    expect(balance2).toBe(10);

    const outcome = new OutcomeService();
    const balance3 = outcome.execute(54321, 8, transactions);
    expect(balance3).toBe(2);
  });

  it('should NOT be able to make a invalid income transaction', async () => {
    try {
      const income = new IncomeService();
      income.execute(54321, -1, transactions);
    } catch (e) {
      expect(e.message).toBe('Valor inválido.');
    }
  });

  it('should NOT be able to make a invalid outcome transaction', async () => {
    try {
      const outcome = new OutcomeService();
      outcome.execute(54321, 10, transactions);
    } catch (e) {
      expect(e.message).toBe('Saldo insuficiente.');
    }
  });
});
