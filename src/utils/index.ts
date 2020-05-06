import { Transaction } from '../contracts';

const getBalance = (
  account: number,
  transactions: Array<Transaction>,
): number => {
  const initialBalance = {
    income: 0,
    outcome: 0,
  };

  const accountTrasactions = transactions.filter(transaction => {
    return transaction.account === account;
  });

  const { income, outcome } = accountTrasactions.reduce(
    (accumulator, transaction) => {
      switch (transaction.type) {
        case 'income':
          accumulator.income += Number(transaction.value);
          break;
        case 'outcome':
          accumulator.outcome += Number(transaction.value);
          break;
        default:
          break;
      }

      return accumulator;
    },
    initialBalance,
  );

  return income - outcome;
};

export default getBalance;
