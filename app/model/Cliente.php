<?php
	class Cliente extends Model
	{
		public $_table = 'clientes';

		private $id_cliente;
		private $nome;


		public function Cliente($id = null)
		{
			if (!empty($id))
			{
				$data = $this->read($id);
				$this->setId($data['id']);
				$this->setNome($data['nome']);
			}	
		}

		//set's
		public function setId($id)
		{
			$this->id_cliente = $id;
		}
		public function setNome($nome)
		{
			$this->nome = $nome;
		}
		//get's
		public function getId()
		{
			return $this->id_cliente;
		}
		public function getNome()
		{
			return $this->nome;
		}

		//extras
		public function listar()
		{
			$aClientes = $this->read();

			foreach($aClientes as $cliente)
			{
				$cliente = new Cliente($cliente['id']);
				$clientes[] = $cliente;
			}
			return $clientes;
		} 


	}

?>