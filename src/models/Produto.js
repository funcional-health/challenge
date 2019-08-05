import mongoose from 'mongoose';

export const Produto = mongoose.model('Produto', { nome: String, industria: String, quantidade: Number, preco: Number});
