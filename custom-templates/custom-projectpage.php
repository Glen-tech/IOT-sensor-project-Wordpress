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
  text-align: left;
}


}

</style>

<body>


<div class= "homepage">
	<?php get_header();?> <!-- calls the header script -->
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?> <!-- gets title of the webpage -->
	
</div>

<div class = "intro">
	<p>Homepage IOT sensor project</p>
</div>



</body>

</html>
