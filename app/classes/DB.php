<?php 
	class DB{

		protected $pdo;
		
		public function __construct()
		{
			try{
				$this->pdo = new PDO('mysql:host=localhost;dbname=twitter_auth', 'root', '');
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}
 ?>