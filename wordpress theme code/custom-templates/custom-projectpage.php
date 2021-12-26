
<html>

<?php

/* Template Name: custom project page*/

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
  text-align: center;
}

.btn-group button {
  margin: auto;
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  width: 80%; /* Set a width if needed */
  display: block; /* Make the buttons appear below each other */
}

br {
   display: block;
   margin: 6px 0;
}

</style>

<body>


<div class= "homepage">
	<?php get_header();?>
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?> 
	
</div>

<div class = "intro">
	<p>Homepage IOT sensor project</p>
</div>



<div class="btn-group"> 
	<button class= "button bt-mini"  onclick="location.href='http://localhost/wordpress/show-table/';">Show table</button>
	</br>
	<button class= "button bt-mini"  onclick="location.href='http://localhost/wordpress/json-sensors-data/';">Show JSON data</button>
	</br>
	<button class= "button bt-mini"> Log out </button>
</div>



</body>

</html>
