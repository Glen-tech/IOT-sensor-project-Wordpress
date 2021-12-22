<?php /* Template Name: custom show data*/ ?>

<?php
	require_once('custom-classes/create_tables_sensors.php'); // check if file is included, if not it will included the file
	
	$object = new create_tables_sensors($query_sensors_id= "", $query_sensors_data= "");
	
	$object->create_sensor_id();
	$object->create_sensor_data();
	
	echo "show data";
?>