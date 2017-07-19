<?php
	class Model
	{
		public $_table;

		private $host = DB_HOST;
		private $user = DB_USER;
		private $database = DB_DATABASE;
		private $password = DB_PASSWORD;
		private $link;
		private $result;


		public function connect()
		{
			$link = mysql_connect($this->host, $this->user, $this->password);
			if (!$link)
				die('Erro ao conectar com o banco de dados');

			$this->link = $link;
			$this->selectDataBase();
		}

		public function disconnect()
		{
			mysql_close($this->link);
		}

		public function selectDataBase()
		{
			
			mysql_select_db($this->database, $this->link);

		}

		public function query($sql)
		{
			//echo $sql.'<br>';
			$this->connect();
			
			$this->result = mysql_query($sql, $this->link);
			if (mysql_errno($this->link))
				die( mysql_error($this->link));
			
				
			if (strpos($sql, "INSERT") === 0) 
			{
				return mysql_insert_id();
			}	

			$this->disconnect();
		}

		public function insert($data)
		{

			$campos = array_keys($data);
			$valores = array_values($data);

			$campos = implode(", ", $campos);
			$valores = "'".implode("', '",$valores)."'";

			return $this->query("INSERT INTO ".$this->_table." ( {$campos} ) VALUES ( {$valores} )");

		}

		public function read($id=null)
		{

				if (!empty($id) && is_numeric($id)) 
					$query = " WHERE id={$id} ";
				elseif(!empty($id))
					$query = " WHERE ".$id;
				else
					$query='';

				$this->query("SELECT * FROM {$this->_table} {$query}");

				if (mysql_num_rows($this->result) > 1 ||  (!is_numeric($id) && empty($id)) )
				{
					while($r = mysql_fetch_assoc($this->result))
					{
						$array[] = $r;
					}	
					return $array;
				}else{
					return mysql_fetch_assoc($this->result);	
				}
		}

		public function manyToMany($table, $query)
		{

			$this->query("SELECT * FROM {$table} WHERE  {$query}");
			while($r = mysql_fetch_assoc($this->result))
			{
				$array[] = $r;
			}	
			return $array;
		}
		
	}	
