import {Produto} from "./models/Produto";

export const resolvers = {
	Query: {
		//Criar produto
		createProduto: (_,{nome,industria,quantidade,preco}) =>{ 
			const produto = new Produto({ nome,industria,quantidade,preco});
			return produto.save();
		},
		//Retornar todos os produtos
		allProdutos: () => Produto.find(),
		//Buscar produtos por indústria
		produtoIndustria: (_,{industria}) =>{ 
			return Produto.find({industria: industria});
		},
		//Remove todos os produtos de dado nome em uma indústria
		produtoRemover: (_,{nome,industria}) =>{ 
			Produto.deleteMany({nome: nome,industria: industria}, function(err) {
				if (err) return res.send(500, { error: err });
			});
			return "Produto removido com sucesso";
		},
		//Atualiza informações de um produto na indústria
		produtoAtualizar: (_,{nome,industria,quantidade,preco}) =>{
			Produto.findOneAndUpdate({nome:nome,industria:industria}, {quantidade:quantidade,preco:preco}, {upsert:true}, function(err, doc){
			    if (err) return res.send(500, { error: err });
			});
			return "Produto atualizado com sucesso";
		},
		
	}
};