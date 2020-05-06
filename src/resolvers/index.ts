import {
  Transaction,
  TransactionRequest,
  TransactionResponse,
  SaldoRequest,
  SaldoResponse,
} from '../contracts';

import getBalance from '../utils';
import IncomeService from '../services/IncomeService';
import OutcomeService from '../services/OutcomeService';

const transactions: Array<Transaction> = [];

const resolvers = {
  saldo({ conta }: SaldoRequest): SaldoResponse {
    const balance = getBalance(conta, transactions);
    return { saldo: balance };
  },

  depositar({ conta, valor }: TransactionRequest): TransactionResponse {
    const income = new IncomeService();
    const balance = income.execute(conta, valor, transactions);
    return { conta, saldo: balance };
  },

  sacar({ conta, valor }: TransactionRequest): TransactionResponse {
    const outcome = new OutcomeService();
    const balance = outcome.execute(conta, valor, transactions);
    return { conta, saldo: balance };
  },
};

export default resolvers;
