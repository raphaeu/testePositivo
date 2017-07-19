<?php
	class PedidoItem extends Model
	{
			public $_table = 'pedidoItens';
			private $id_pedido;
			private $id_produto;
			private $qtd;
			private $preco;


			public function PedidoItem($id_pedido = null, $id_produto = null)
			{
				if (!empty($id_pedido) && !empty($id_produto))
				{

					$data = $this->read("id_pedido={$id_pedido} AND id_produto={$id_produto}");
					$this->setIdPedido($data['id_pedido']);
					$this->setIdProduto($data['id_produto']);
					$this->setQtd($data['qtd']);
					$this->setPreco($data['preco']);

				}	
			}


			public function produto()
			{
				return new Produto($this->getIdProduto());
			}			


			public function getTotal()
			{
				return $this->qtd * $this->getPreco();
			}

			public function getTotalVolume()
			{
				return $this->qtd * $this->produto()->getVolume();
			}


			//set's
			public function setId($id)
			{
				$this->id = $id;
			}
			public function setIdPedido($id)
			{

				$this->id_pedido = $id;;
			}
			public function setIdProduto($id)
			{
				$this->id_produto = $id;
			}
			public function setQtd($qtd)
			{
				$this->qtd = $qtd;
			}
			public function setPreco($preco)
			{
				$this->preco = $preco;
			}
			//get's
			public function getId()
			{
				return $this->id ;
			}
			public function getIdPedido()
			{
				return $this->id_pedido;
			}
			public function getIdProduto()
			{
				return $this->id_produto;
			}
			public function getQtd()
			{
				return $this->qtd ;
			}
			public function getPreco()
			{
				return $this->preco;
			}

			//outros methodos
			public function gravar()
			{
				$data = array(
					'id_pedido'=>$this->getIdPedido()
					,'id_produto'=>$this->getIdProduto()
					,'preco'=>$this->getPreco()
					,'qtd'=>$this->getQtd()
				);	
				$this->insert($data);
			}

	}

?>