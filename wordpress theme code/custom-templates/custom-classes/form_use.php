<?php

	class arrived_form_data
	{
		
		/*
		*@var string $check_username Check_username
		*@var string $check_password Check_password
		*@var string $query_username Check_password
		*@var string $query_password Query_password
		*@var string $result_query_username Result_query_username
		*@var string $result_query_password Result_query_password
		*/
		
		private $check_username;
		private $check_password;
		
		private $query_username;
		private $query_password;
		
		private $result_query_username;
		private $result_query_password;
		
		
		/*
		*@abstract = initialize the object's properties
		*@param:$this->check_username = stores the value of username what was inserted in the form for later checking
		*@param:$this->check_password = stores the value of the password what was inserted in the form for later checking
		*@param:$this->query_username = placeholder for $this->check_username
		*@param:$this->query_password = placeholder for $this->check_password
		*@param:$this->result_query_username = querry result to check that the insert username value is in the column username
		*@param:$this->result_query_password = querry result to check that the insert password value is in the column password
		*/
			
		public function __construct($check_username,$check_password,$query_username, $query_password , $result_query_username , $result_query_password)
		{
			$this->check_username =$check_username; // $this is used for a reference to the current property
			$this->check_password =$check_password;
			
			$this->query_username= $query_username;
			$this->query_password= $query_password;
			
			$this->result_query_username= $result_query_username;
			$this->result_query_password= $result_query_password;
		}
		
		/*
		* @abstract = get post variables of the form from custom-homepage.php if it is set 
		* @param: $this->check_username  = stores the value of username what was inserted in the form for later checking
		* @param: $this->check_password = stores the value of the password what was inserted in the form for later checking
		*/
		
		public function get_post_form() 
		{
			if(isset($_POST['username'],$_POST['password']) === true) // check if both values of the form are submitted 
			{
				$this->check_username = $_POST['username'];
				$this->check_password = $_POST['password'];
			}	
		}
		
		/*
		* @abstract = checkes if the username that is inserted is the same than the username in the table wp_user_login of the database bitnami_wordpress
		* @global: $wpdb = used to interact with a database without needing to use raw SQL statements
		* @param: $this->check_username  = stores the value of username what was inserted in the form for later checking
		* @param: $query_username = placeholder for $this->check_username 
		* @param: $this->result_query_username = querry result to check that the insert username value is in the column username
		*/
		
		public function check_username()
		{   
			global $wpdb;
		
			/*All data in SQL queries must be SQL-escaped before the SQL query is executed to prevent against SQL injection attacks.
			The prepare method performs this functionality for WordPress*/
			
			$query_username = $this->check_username; 
			
			$this->result_query_username = $wpdb->get_var(
					$wpdb->prepare(
						"
							SELECT username
							FROM ".$wpdb->prefix."user_login
							WHERE username = %s
						",
						$query_username
					)
				);
				
		}
		
		/*
		* @abstract = checkes if the password that is inserted is the same than the password in the table wp_user_login of the database bitnami_wordpress
		* @global: $wpdb  = used to interact with a database without needing to use raw SQL statements
		* @param: $this->check_password  = stores the value of the password what was inserted in the form for later checking
		* @param: $query_password = placeholder for $this->check_username 
		* @param: $this->result_query_password = querry result to check that the insert password value is in the column password
		*/
		
		public function check_password()
		{
			global $wpdb;
			
			/*All data in SQL queries must be SQL-escaped before the SQL query is executed to prevent against SQL injection attacks.
			The prepare method performs this functionality for WordPress*/
		
			$query_password = $this->check_password;
			
			$this->result_query_password = $wpdb->get_var(
					$wpdb->prepare(
						"
							SELECT password
							FROM ".$wpdb->prefix."user_login
							WHERE password = %s
						",
						$query_password
					)
				);
				
		}
		
		/*
		* @abstract = checks if the inserted username and password is the same than the table in wp_user_login of the database bitnami_wordpress , if so proceed to project page
		* @param :$this->check_username = stores the value of username what was inserted in the form for later checking
		* @param: $this->result_query_username = querry result to check that the insert username value is in the column username
		* @param: $this->check_password  = stores the value of the password what was inserted in the form for later checking
		* @param: $this->result_query_password = querry result to check that the insert password value is in the column password
		* @param: $page_object = stores the title of the website where it will be redirected
		* @param: $page_id = gets the ID of the website where it will be redirected
		* @param: $permalink = the URL of the website where it will be redirected
		*/
		public function login_to_project()
		{	
			if((strcmp($this->check_username, $this->result_query_username) === 0 ) && (strcmp($this->check_password,$this->result_query_password) === 0)) 
			{
				$page_title = get_page_by_title("Project page");
				$page_id = $page_title->ID; // find ID of the Project page
				$permalink = get_permalink( $page_id ); // gets URL
				echo '<script language="javascript">window.location.href ="'.$permalink.'"</script>'; // javascript for redirecting to the Project page url
			}
				else
				{
					echo "Please give right username and password";
				}
		}
		
		//Is called when the script is ended or exit , does deallocate memory and other cleanup for a class object and its class members when the object is destroyed.
		
		public function __destruct() 
		{
			
		}
	}
?>

