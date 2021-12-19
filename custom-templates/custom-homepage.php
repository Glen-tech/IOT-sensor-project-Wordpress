<html>


<?php

/* Template Name: custom homepage*/

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
?>

<style>
.homepage{
  margin: auto;
  width: 30%;
  text-align: center;
} 

.intro{
  margin: auto;
  width: 80%;
  text-align: left;
}

.form{
  margin: auto;
  width: 80%;
  text-align: left;
}

.login{
    height: 320px;
    width: 300px;
    position: absolute;
    transform: translate(-50%,-50%);
    top: 75%;
    left: 44%;
    padding: 50px 35px;
}

</style>

<body>


<div class= "homepage">
	<?php get_header();?> <!-- calls the header script -->
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?> <!-- gets title of the webpage -->
	
</div>

<div class = "intro">

	<p>Welcome to the IOT sensor project in wordpress</p>
	<p>This project is created for a exploring of the technology wordpress</p>
	<p>Login for continue</p>
	
</div>


<?php
	require_once('custom-classes/form_use.php'); // check if file is included, if not it will included the file
	
	if (isset($_POST['submit'])) // when a post is happend of the button of the form
	{
		if(!empty($_POST['username']) && !empty($_POST['password'])) // if form is filled out proceed
		{
			// call the instances one by one
			
			$object = new arrived_form_data($check_username="",$check_password="",$query_username="",$query_password="" , $prepare_query= "" , $result_query_username = "", $result_query_password = "");  // creat new object of the class arrived_from_data 
			$object -> get_post_form();  
			$object -> check_username(); 
			$object -> check_password();
			$object -> login_to_project();
		}
			else  
			{
				echo "Please insert username and password";
			}
	}
	
?>


<div class= "form">

	<form class= "login" method= "POST">
	
    <label>User Name   </label>

    <input type="text" name="username" placeholder="User Name"><br>

    <label>Password   </label>
   
    <input type="password" name="password" placeholder="Password"><br><br> 

    <button class= "button bt-mini" name="submit" type="submit" value='submit'>Login</button>

    </form>
	
</div>



</body>

</html>
