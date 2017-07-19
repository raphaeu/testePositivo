<?php
	class Produto extends Model
	{
		public $_table = 'produtos';

		private $id_produto;
		private $nome;
		private $volume;
		private $preco;

		public function Produto($id = null)
		{
			if (!empty($id))
			{
				$data = $this->read($id);
				$this->setId($data['id']);
				$this->setNome($data['nome']);
				$this->setVolume($data['volume']);
				$this->setPreco($data['preco']);
			}	
		}

		//set's
		public function setId($id)
		{
			$this->id_produto = $id;
		}
		public function setNome($nome)
		{
			$this->nome = $nome;
		}
		public function setVolume($volume)
		{
			$this->volume = $volume;
		}
		public function setPreco($preco)
		{
			$this->preco = $preco;
		}
		//get's
		public function getId()
		{
			return $this->id_produto;
		}
		public function getNome()
		{
			return $this->nome;
		}
		public function getVolume()
		{
			return $this->volume;
		}
		public function getPreco()
		{
			return $this->preco;
		}

		//extras

		public function listar()
		{
			$aProdutos = $this->read();
				
			foreach($aProdutos as $produto)
			{
				$produto = new Produto($produto['id']);
				$produtos[] = $produto;
			}
			return $produtos;
		} 


	}

?>