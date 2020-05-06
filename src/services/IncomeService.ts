import { Transaction } from '../contracts';
import getBalance from '../utils';

class IncomeService {
  public execute(
    conta: number,
    valor: number,
    transactions: Array<Transaction>,
  ): number {
    if (valor <= 0) {
      throw new Error('Valor inválido.');
    }

    transactions.push({
      type: 'income',
      account: conta,
      value: valor,
    });

    return getBalance(conta, transactions);
  }
}

export default IncomeService;
