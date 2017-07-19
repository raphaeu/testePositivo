<?php
	include_once(MODELS.'Produto.php');
	include_once(MODELS.'Cliente.php');
	include_once(MODELS.'PedidoItem.php');
	include_once(MODELS.'Embalagem.php');

	class pedidoController extends controller
	{


		public function dados()
		{
			
			$pedido = new Pedido($_GET['id']);

			$this->view('pedido/dados',$pedido );
		}



		public function formulario()
		{
			$produto = new Produto();
			$cliente = new Cliente();

			$produtos = $produto->listar();
			$clientes = $cliente->listar();

			$this->view('pedido/form', array('produtos'=>$produtos, 'clientes'=>$clientes, 'pedido'=>array('dt_pedido'=> date('d/m/Y')) ));
		}

		public function fecharPedido()
		{

			if($_POST['data']['pedido']['dt_pedido'] == '')
			{
				$error[] = "O campo data e obrigatório<br>";
				$url_error .= "&dt_pedido={$_POST['data']['pedido']['dt_pedido']}";
			}
			foreach($_POST['data']['produtos']as $produto)
			{
				if ($produto['qtd'] > 0) 
					@$flag = true;
				$url_error .= "&produto[{$produto['id']}][qtd]={$produto['qtd']}";
			}
		
			if (!isset($flag))
				$error[] = "Informe pelo menos a quantidade de 1 produto.<br>"; 	

			if (isset($error))
			{
				foreach($error as $erro)
					$url_error .= "&errors[]=$erro";

				$this->redirect("index.php?modulo=pedido&acao=formulario{$url_error}");
			}
			
			$pedido = new Pedido();
			$pedido->setIdCliente($_POST['data']['cliente']['id']);
  			$data = explode('/', $_POST['data']['pedido']['dt_pedido']);
			$pedido->setDtPedido($data[2].'-'.$data[1].'-'.$data[0]);
			$pedido->gravar();


			foreach($_POST['data']['produtos'] as $produto)
			{

				if ( $produto['qtd'] > 0)
				{

					$pedidoItem = new pedidoItem();
					$pedidoItem->setIdPedido($pedido->getId());
					$pedidoItem->setIdProduto($produto['id']);
					$pedidoItem->setPreco($produto['preco']);
					$pedidoItem->setQtd($produto['qtd']);
					$pedidoItem->gravar();
				}	
			}	
			$this->redirect('index.php?modulo=pedido&acao=dados&id='.$pedido->getId());

		}


	}