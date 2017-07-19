<?php
	class Embalagem extends Model
	{
		public $_table = 'embalagens';

		private $id_embalagem;
		private $nome;
		private $volume;
		private $preco;
		private $qtd;

		public function Embalagem($id = null)
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
		public function calculaTotalPreco($volumeTotal)
		{
			$array = $this->listar();

			foreach($array as $embalagem )
			{
				$volumes[$embalagem->getVolume()] = $embalagem->getId();
				$embalagens[$embalagem->getId()]= $embalagem;
			}	
			krsort($volumes);
			
			while($volumeTotal > 0)
			{
				foreach($volumes as $volume => $id)
				{	
					//echo "<h2>Volume embalagem: {$embalagens[$id]->getVolume()} do total de :{ $volumeTotal}</h2>";
					if ($volumeTotal >= $embalagens[$id]->getVolume())
					{
						//echo "<h2>{$embalagens[$id]->getPreco()}</h2>";
						$volumeTotal -= $volume;
						@$totalPreco += $embalagens[$id]->getPreco();
						break;   			
					}
				}

				@$x++;if ($x>1000) break;
			}

			return $totalPreco;
		}

		public function calculaTotalEmbalagens($volumeTotal)
		{
			$array = $this->listar();

			foreach($array as $embalagem )
			{
				$volumes[$embalagem->getVolume()] = $embalagem->getId();
				$embalagens[$embalagem->getId()]= $embalagem;
			}	
			krsort($volumes);
			
			while($volumeTotal > 0)
			{
				foreach($volumes as $volume => $id)
				{	
					//echo "<h2>Volume embalagem: {$embalagens[$id]->getVolume()} do total de :{ $volumeTotal}</h2>";
					if ($volumeTotal >= $embalagens[$id]->getVolume())
					{
						//echo "<h2>{$embalagens[$id]->getPreco()}</h2>";
						$volumeTotal -= $volume;
						@$embalagensUsadas[$volume] = $embalagens[$id];
						$embalagensUsadas[$volume]->setQtd($embalagensUsadas[$volume]->getQtd() + 1);   
						break;			
					}
				}

				@$x++;if ($x>1000) break;
			}

			return $embalagensUsadas;


		}


		public function setId($id)
		{
			$this->id_embalagem = $id;
		}
		public function setQtd($qtd)
		{
			$this->qtd = $qtd;
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
			return $this->id_embalagem;
		}
		public function getQtd()
		{
			return $this->qtd;
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
			$aEmbalagems = $this->read();

			foreach($aEmbalagems as $embalagem)
			{
				$embalagem = new Embalagem($embalagem['id']);
				$embalagems[] = $embalagem;
			}
			return $embalagems;
		} 


	}

?>