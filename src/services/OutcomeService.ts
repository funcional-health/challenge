import { Transaction } from '../contracts';
import getBalance from '../utils';

class OutcomeService {
  public execute(
    conta: number,
    valor: number,
    transactions: Array<Transaction>,
  ): number {
    const currentBalance = getBalance(conta, transactions);

    const hasFunds = (): boolean => {
      return currentBalance - valor >= 0;
    };

    if (!hasFunds()) {
      throw new Error('Saldo insuficiente.');
    }

    transactions.push({
      type: 'outcome',
      account: conta,
      value: valor,
    });

    return getBalance(conta, transactions);
  }
}

export default OutcomeService;
