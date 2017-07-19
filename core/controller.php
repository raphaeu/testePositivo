<?php
	class Controller
	{
		public function view($file, $data=null)
		{
			if (!file_exists(VIEWS.$file.'.php'))
				die("A view {$file} nao existe");
			include_once(VIEWS.$file.'.php');
		}
		public function redirect($url)
		{
			header("location: {$url}");
			exit;
		}
	}

?>