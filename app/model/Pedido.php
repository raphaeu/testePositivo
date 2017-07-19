<?php
	class Pedido extends Model
	{
			public $_table = 'pedidos';
			private $id;
			private $id_cliente;
			private $dt_pedido;
			private $totalPreco;
			private $totalVolume;

			public function Pedido($id = null)
			{
				if (!empty($id))
				{
					$data = $this->read($id);
					$this->setId($data['id']);
					$this->setIdCliente($data['id_cliente']);
					$this->setDtPedido($data['dt_pedido']);
				}	
			}

			public function cliente()
			{
				return new Cliente($this->getIdCliente());
			}

			public function itens()
			{
				$itens = $this->manyToMany('pedidoItens', 'id_pedido='.$this->getId());
				foreach($itens as $item)
				{
					$pedidoItem = new PedidoItem($this->getId(), $item['id_produto']);
					@$totalPreco +=  $pedidoItem->getTotal();
					@$totalVolume +=  $pedidoItem->getTotalVolume();

					$pedidoItens[] = $pedidoItem;
				}
				$this->setTotalPreco($totalPreco);
				$this->setTotalVolume($totalVolume);

				return $pedidoItens; 
			}


			public function getTotalVolumePreco()
			{
				$embalagem = new Embalagem();
				return  $embalagem->calculaTotalPreco($this->getTotalVolume());
			}

			public function getTotalEmbalagens()
			{
				$embalagem = new Embalagem();
				return  $embalagem->calculaTotalEmbalagens($this->getTotalVolume());
			}


			//set's
			public function setTotalPreco($totalPreco)
			{
				$this->totalPreco = $totalPreco;	
			}

			public function setTotalVolume($totalVolume)
			{
				$this->totalVolume = $totalVolume;	
			}

			public function setId($id)
			{
				$this->id = $id;
			}
			public function setIdCliente($id)
			{
				$this->id_cliente = $id;
			}
			public function setDtPedido($dtPedido)
			{
				$this->dt_pedido = $dtPedido;
			}

			//get's
			public function getTotalPreco()
			{
				return $this->totalPreco;
			}
			public function getTotalVolume()
			{
				return $this->totalVolume;
			}
			public function getId()
			{
				return $this->id;
			}
			public function getIdCliente()
			{
				return $this->id_cliente;
			}
			public function getDtPedido()
			{
				return $this->dt_pedido;
			}

			//outros methodos
			public function gravar()
			{
				$data = array(
					'id_cliente'=>$this->getIdCliente()
					,'dt_pedido'=>$this->getDtPedido()

				);	
				$id = $this->insert($data);
				$this->setId($id);
			}

	}

?>