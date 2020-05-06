export interface Transaction {
  type: 'income' | 'outcome';
  account: number;
  value: number;
}

export interface TransactionRequest {
  conta: number;
  valor: number;
}

export interface TransactionResponse {
  conta: number;
  saldo: number;
}

export interface SaldoResponse {
  saldo: number;
}

export interface SaldoRequest {
  conta: number;
}
