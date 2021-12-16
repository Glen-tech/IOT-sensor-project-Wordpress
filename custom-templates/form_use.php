<?php
	class arrived_form_data
	{
		protected $conn;
		protected $mysql;
		
		private $username;
		private $password;
		
		private $check_username;
		private $check_password;
			
		public function __construct()
		{
			$conn = "";
			$mysql = "";
			
			$username = "";
			$password= "";
			
			$check_username= "";
			$check_password= "";
		}
		
		public function get_post() // get post variables of custom-homepage.php
		{
			$username = $_POST['username'];
			$password= $_POST['password'];
		}
		
		
		public function connect_db() // Makes connection with the database
		{
			include logfile.php;
			
			$conn = new mysql($servername, $username, $password,$dbname); // connect to database
			
			if (mysqli_connect_error()) 
			{
			  die("Database connection failed: " . mysqli_connect_error());
			  exit();
			}

			
		}
		
		public function check_table() // checkes if the post variables is the same then the values in the table
		{
			$mysql = new mysqli($servername, $username, $password, $dbname);
			$check_username =  $mysql->query("SELECT username FROM login WHERE username = '".$username."'"); // select the username and compare it with the post variable
			$check_password = $mysql->query("SELECT password FROM login WHERE password = '".$password."'"); // select the password and compare it with the post variable
			
			echo $check_username; 
			echo $check_password;
			
			$mysql->close();
			
		}
		
		public function check_completed()
		{
			
		}
		
		public function __destruct() 
		{
        
		}
	}
?>

<?php

	if ($_SERVER['REQUEST_METHOD'] === 'POST') // when a post is happend 
	{
		$object = new arrived_form_data();  // creat new object of the class arrived_from_data
		$object -> get_post(); // call the instances one by one
		$object -> connect_db();
		$object -> check_db();
		$object -> check_completed();
	}
?>