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
	<button class="button bt-mini">Show data</button>
	<button class="button bt-mini">Show table</button>
</div>



</body>

</html>
